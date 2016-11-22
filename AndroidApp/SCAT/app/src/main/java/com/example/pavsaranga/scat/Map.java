package com.example.pavsaranga.scat;

import android.app.AlertDialog;
import android.content.ContentResolver;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.location.Criteria;
import android.location.Location;
import android.location.LocationListener;
import android.location.LocationManager;
import android.os.Bundle;
import android.provider.Settings;
import android.support.v4.app.FragmentActivity;
import android.widget.Toast;

import com.google.android.gms.maps.CameraUpdateFactory;
import com.google.android.gms.maps.GoogleMap;
import com.google.android.gms.maps.OnMapReadyCallback;
import com.google.android.gms.maps.SupportMapFragment;
import com.google.android.gms.maps.model.LatLng;
import com.google.android.gms.maps.model.MarkerOptions;

public class Map extends FragmentActivity implements OnMapReadyCallback {

    private GoogleMap mMap;
    private LocationManager locationMangaer = null;
    private LocationListener locationListener = null;
    private Boolean flag = false;
    double longitude, latitude;
    LatLng myLocation;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        locationMangaer = (LocationManager) getSystemService(Context.LOCATION_SERVICE);
        flag =isGPSOn();
        if (!flag) {
            gpsAlert();
        }
        locationListener = new MyLocationListener();
        Criteria criteria = new Criteria();
        String provider = locationMangaer.getBestProvider(criteria, true);
        Location location = locationMangaer.getLastKnownLocation(provider);
        if(location != null){
            longitude = location.getLongitude();
            latitude = location.getLatitude();
            myLocation = new LatLng(latitude, longitude);
        } else {
            locationMangaer.requestLocationUpdates(LocationManager.GPS_PROVIDER, 5000, 1, locationListener);
        }
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_map);
        SupportMapFragment mapFragment = (SupportMapFragment) getSupportFragmentManager().findFragmentById(R.id.map);
        mapFragment.getMapAsync(this);
    }

    private Boolean isGPSOn() {
        ContentResolver contentResolver = getBaseContext().getContentResolver();
        boolean gpsStatus = Settings.Secure.isLocationProviderEnabled(contentResolver, LocationManager.GPS_PROVIDER);
        if (gpsStatus) {
            return true;
        } else {
            return false;
        }
    }

    protected void gpsAlert() {
        AlertDialog.Builder builder = new AlertDialog.Builder(this);
        builder.setMessage("Your Device's GPS is Disable")
                .setCancelable(false)
                .setTitle("Gps Status")
                .setPositiveButton("Turn On",
                        new DialogInterface.OnClickListener() {
                            public void onClick(DialogInterface dialog, int id) {
                                // finish the current activity
                                // AlertBoxAdvance.this.finish();
                                Intent myIntent = new Intent(Settings.ACTION_LOCATION_SOURCE_SETTINGS);
                                startActivity(myIntent);
                                dialog.cancel();
                            }
                        })
                .setNegativeButton("Cancel",
                        new DialogInterface.OnClickListener() {
                            public void onClick(DialogInterface dialog, int id) {
                                // cancel the dialog box
                                dialog.cancel();
                            }
                        });
        AlertDialog alert = builder.create();
        alert.show();
    }

    @Override
    public void onMapReady(GoogleMap googleMap) {
        mMap = googleMap;
        mMap.setMyLocationEnabled(true);
        mMap.setIndoorEnabled(true);
        try {
            mMap.addMarker(new MarkerOptions().position(myLocation).title("You Are Here!"));
            mMap.moveCamera(CameraUpdateFactory.newLatLng(myLocation));
        } catch(Exception e){
            e.printStackTrace();
        }
    }

    @Override
    protected void onPause() {
        super.onPause();
    }

    private class MyLocationListener implements LocationListener {

        @Override
        public void onLocationChanged(Location loc) {
            longitude = loc.getLongitude();
            latitude = loc.getLatitude();
            //Toast.makeText(Map.this, "LAT"+latitude+"\n"+"LON"+longitude, Toast.LENGTH_LONG).show();
            myLocation = new LatLng(latitude, longitude);
            try {
                mMap.addMarker(new MarkerOptions().position(myLocation).title("You Are Here!"));
                mMap.moveCamera(CameraUpdateFactory.newLatLng(myLocation));
            } catch(Exception e){
                e.printStackTrace();
            }
        }

        @Override
        public void onProviderDisabled(String provider) {
            Toast.makeText(Map.this,"GPS Disabled",Toast.LENGTH_SHORT).show();
        }

        @Override
        public void onProviderEnabled(String provider) {
            Toast.makeText(Map.this,"GPS Enabled",Toast.LENGTH_SHORT).show();
        }

        @Override
        public void onStatusChanged(String provider, int status, Bundle extras) {
            Toast.makeText(Map.this,"GPS State Changed",Toast.LENGTH_SHORT).show();
        }
    }
}
