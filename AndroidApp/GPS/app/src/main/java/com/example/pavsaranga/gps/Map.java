package com.example.pavsaranga.gps;

import android.app.AlertDialog;
import android.content.ContentResolver;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.SharedPreferences;
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

import java.io.BufferedReader;
import java.io.InputStreamReader;
import java.io.OutputStreamWriter;
import java.net.URL;
import java.net.URLConnection;
import java.net.URLEncoder;

public class Map extends FragmentActivity implements OnMapReadyCallback {

    private GoogleMap mMap;
    private LocationManager locationMangaer = null;
    private LocationListener locationListener = null;
    private Boolean flag = false;
    double longitude, latitude;
    LatLng myLocation;
    StringBuilder sb;
    String tId;
    SharedPreferences userDetails;

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
        mMap.setIndoorEnabled(true);
        try {
            mMap.addMarker(new MarkerOptions().position(myLocation).title("You Are Here!"));
            mMap.moveCamera(CameraUpdateFactory.newLatLng(myLocation));
            System.out.println(latitude+" "+longitude);
            //send lat long to the php code
            userDetails = getApplicationContext().getSharedPreferences("MyId", Context.MODE_PRIVATE);
            tId = userDetails.getString("ID", "");
            if(!tId.equals("")){
                Thread t1 = new Thread(new Runnable() {
                    @Override
                    public void run() {
                        sendLocation();
                    }
                });
                t1.start();
            } else {
                Toast.makeText(Map.this,"Please set the Train ID before sending data to the server.",Toast.LENGTH_SHORT).show();
            }
        } catch(Exception e){
            e.printStackTrace();
        }
    }

    private void sendLocation() {
        try{
            String link="http://192.168.43.73:1234/SCAT/mobile/src/setGps.php";
            newThread("Train ID : " + tId);
            String data  = URLEncoder.encode("trainId", "UTF-8") + "=" + URLEncoder.encode(tId.toString(), "UTF-8");
            data += "&" + URLEncoder.encode("latitude", "UTF-8") + "=" + URLEncoder.encode(Double.toString(latitude), "UTF-8");
            data += "&" + URLEncoder.encode("longitude", "UTF-8") + "=" + URLEncoder.encode(Double.toString(longitude), "UTF-8");
            URL url = new URL(link);
            URLConnection conn = url.openConnection();
            conn.setDoOutput(true);
            OutputStreamWriter wr = new OutputStreamWriter(conn.getOutputStream());
            wr.write( data );
            wr.flush();
            BufferedReader reader = new BufferedReader(new InputStreamReader(conn.getInputStream()));
            sb = new StringBuilder();
            String line = null;
            // Read Server Response
            while((line = reader.readLine()) != null) {
                sb.append(line);
                break;
            }
            setOutPut();
        } catch(Exception e){
            e.printStackTrace();
        }
    }

    private void setOutPut() {
        String message = sb.toString();
        switch(message){
            case "EMPTY":
                newThread("Required Fields Cannot Be Empty.");
                break;
            case "TID":
                newThread("Wrong Train ID Format.");
                break;
            case "LAT":
                newThread("Wrong Latitude Format.");
                break;
            case "LON":
                newThread("Wrong Longitude Format.");
                break;
            case "FAIL":
                newThread("Couldn't send data to the server.");
                break;
            case "SUCCESS":
                newThread("Successfully sent the location to the server.");
                break;
        }
    }

    private void newThread(String msg) {
        final String toast = msg;
        this.runOnUiThread(new Runnable() {
            @Override
            public void run() {
                Toast.makeText(Map.this,toast,Toast.LENGTH_SHORT).show();
            }
        });
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
            myLocation = new LatLng(latitude, longitude);
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
