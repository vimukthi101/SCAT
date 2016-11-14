package com.example.pavsaranga.scat;

import android.content.Context;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.widget.TableLayout;
import android.widget.Toast;

import org.json.JSONException;
import org.json.JSONObject;

import java.io.BufferedReader;
import java.io.InputStreamReader;
import java.io.OutputStreamWriter;
import java.net.URL;
import java.net.URLConnection;
import java.net.URLEncoder;

/**
 * Created by P.A.V.Saranga on 30-Oct-16.
 */
public class Travel extends AppCompatActivity {

    TableLayout tl;
    StringBuilder sb;
    String id, result;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.travel);
        tl = (TableLayout)findViewById(R.id.tlTravel);
        getPrefs();
        Thread t1 = new Thread(new Runnable() {
            @Override
            public void run() {
                getResponse();
            }
        });
        t1.start();

//        for(int i=0; i<5; i++){
//            TableRow row= new TableRow(this);
//            TableRow.LayoutParams lp = new TableRow.LayoutParams(TableRow.LayoutParams.WRAP_CONTENT);
//            row.setLayoutParams(lp);
//            TextView date = new TextView(this);
//            TextView inStation = new TextView(this);
//            TextView outStation = new TextView(this);
//            TextView tickets = new TextView(this);
//            TextView amount = new TextView(this);
//            date.setText("2016");
//            inStation.setText("colombo");
//            outStation.setText("kandy");
//            tickets.setText("5");
//            amount.setText("500.00");
//            row.addView(date);
//            row.addView(inStation);
//            row.addView(outStation);
//            row.addView(tickets);
//            row.addView(amount);
//            tl.addView(row, i);
//        }
    }

    private void getPrefs() {
        SharedPreferences userDetails = getApplicationContext().getSharedPreferences("MyPrefs", Context.MODE_PRIVATE);
        id = userDetails.getString("NIC", "");
    }

    private void getResponse() {
        try{
            String link="http://192.168.43.73:1234/SCAT/mobile/src/travel.php";
            String data  = URLEncoder.encode("nic", "UTF-8") + "=" + URLEncoder.encode(id, "UTF-8");
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
            case "EMPTY":
                newThread("Please Login To Continue.");
                break;
            case "NODATA":
                newThread("No Data To Display.");
                break;
            default:
                try {
                    //get json data
                    JSONObject json_data = new JSONObject(message);
                    result = json_data.getString("result");
                } catch (JSONException e) {
                    e.printStackTrace();
                }
                if (!result.isEmpty() && result.equals("SUCCESS")) {
                    //set data to the table rows
                    newThread("SUCCESS.");
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
                Toast.makeText(Travel.this,toast,Toast.LENGTH_SHORT).show();
            }
        });
    }
}