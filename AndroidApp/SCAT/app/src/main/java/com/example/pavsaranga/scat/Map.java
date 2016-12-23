package com.example.pavsaranga.scat;

import android.app.AlertDialog;
import android.content.ContentResolver;
import android.content.DialogInterface;
import android.content.Intent;
import android.location.LocationManager;
import android.os.Bundle;
import android.os.Handler;
import android.os.Looper;
import android.provider.Settings;
import android.support.v4.app.FragmentActivity;
import android.widget.Toast;

import com.google.android.gms.maps.GoogleMap;
import com.google.android.gms.maps.OnMapReadyCallback;
import com.google.android.gms.maps.SupportMapFragment;
import com.google.android.gms.maps.model.LatLng;
import com.google.android.gms.maps.model.MarkerOptions;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.BufferedReader;
import java.io.InputStreamReader;
import java.io.OutputStreamWriter;
import java.net.URL;
import java.net.URLConnection;
import java.net.URLEncoder;

public class Map extends FragmentActivity implements OnMapReadyCallback {

    private GoogleMap mMap;
    StringBuilder sb;
    JSONObject json_data;
    String result, id, lat, lon;
    LatLng myLocation;
    private Boolean flag = false;
    Double latitude, longitude;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        flag =isGPSOn();
        if (!flag) {
            gpsAlert();
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
        Thread t1 = new Thread(new Runnable() {
            @Override
            public void run() {
                getResponse();
            }
        });
        t1.start();
    }

    private void getResponse() {
        try{
            String link="http://192.168.43.73:1234/SCAT/mobile/src/getGps.php";
            String data  = URLEncoder.encode("train", "UTF-8") + "=" + URLEncoder.encode("get", "UTF-8");
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
        switch(message) {
            case "FAIL":
                newThread("Couldn't track the trains. Please try again later.");
                break;
            case "NODATA":
                newThread("Currently no trains can be tracked. Please try again later.");
                break;
            default:
                try {
                    //get json data
                    json_data = new JSONObject(message);
                    result = json_data.getString("result");
                } catch (JSONException e) {
                    e.printStackTrace();
                }
                if (!result.isEmpty() && result.equals("SUCCESS")) {
                    try {
                        //get json data
                        JSONArray array = json_data.getJSONArray("list");
                        for(int i=0; i<array.length();i++){
                            JSONObject job = array.getJSONObject(i);
                            id = job.getString("id");
                            lat = job.getString("lat");
                            lon = job.getString("lon");
                            latitude = Double.parseDouble(lat);
                            longitude = Double.parseDouble(lon);
                            try {
                                Handler handler = new Handler(Looper.getMainLooper());
                                handler.post(new Runnable(){
                                     @Override
                                     public void run() {
                                         myLocation = new LatLng(latitude, longitude);
                                         mMap.addMarker(new MarkerOptions().position(myLocation).title("Train ID : " + id));
                                     }
                                 });
                            } catch(Exception e){
                                e.printStackTrace();
                            }
                        }
                    } catch (JSONException e) {
                        e.printStackTrace();
                    }
                } else {
                    newThread("Please Try Again Later.");
                }
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
}
