package com.example.pavsaranga.gps;

import android.app.Activity;
import android.content.Context;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.Spinner;
import android.widget.Toast;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.BufferedReader;
import java.io.InputStreamReader;
import java.io.OutputStreamWriter;
import java.net.URL;
import java.net.URLConnection;
import java.net.URLEncoder;
import java.util.ArrayList;
import java.util.List;

/**
 * Created by P.A.V.Saranga on 23-Dec-16.
 */
public class Settings extends Activity implements AdapterView.OnItemSelectedListener {

    Spinner tList;
    Button setTId;
    SharedPreferences sharedpreferences;
    String item, result;
    StringBuilder sb;
    JSONObject json_data;
    List<String> idList;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.settings);
        tList = (Spinner) findViewById(R.id.tIdList);
        setTId = (Button)findViewById(R.id.bSave);
        idList = new ArrayList<String>();
        Thread t1 = new Thread(new Runnable() {
            @Override
            public void run() {
                sendLocation();
            }
        });
        t1.start();
    }

    private void sendLocation() {
        try{
            String link="http://192.168.43.73:1234/SCAT/mobile/src/getTrainList.php";
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
        switch(message){
            case "FAIL":
                newThread("Couldn't get Train List. Please try again later.");
                break;
            case "NODATA":
                newThread("No data to send.");
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
                            String id = job.getString("id");
                            idList.add(id);
                        }
                        newThread("List updated successfully");
                        // Creating adapter for spinner
                        ArrayAdapter<String> dataAdapter = new ArrayAdapter<String>(this, android.R.layout.simple_spinner_item, idList);
                        // Drop down layout style - list view with radio button
                        dataAdapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
                        // attaching data adapter to spinner
                        tList.setAdapter(dataAdapter);
                        tList.setOnItemSelectedListener(this);
                        setTId.setOnClickListener(new View.OnClickListener() {
                            @Override
                            public void onClick(View v) {
                                sharedpreferences = getSharedPreferences("MyId", Context.MODE_PRIVATE);
                                SharedPreferences.Editor editor = sharedpreferences.edit();
                                editor.clear();
                                editor.putString("ID",item);
                                editor.commit();
                                Toast.makeText(Settings.this, "Train ID set : " + item, Toast.LENGTH_LONG).show();
                            }
                        });
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
                Toast.makeText(Settings.this,toast,Toast.LENGTH_SHORT).show();
            }
        });
    }

    @Override
    public void onItemSelected(AdapterView<?> parent, View view, int position, long id) {
        // On selecting a spinner item
        item = parent.getItemAtPosition(position).toString();
        // Showing selected spinner item
        Toast.makeText(parent.getContext(), "Selected : " + item, Toast.LENGTH_LONG).show();
    }

    @Override
    public void onNothingSelected(AdapterView<?> parent) {

    }
}
