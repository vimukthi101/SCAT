package com.example.pavsaranga.scat;

import android.content.Context;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.widget.TableLayout;
import android.widget.TableRow;
import android.widget.TextView;
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

/**
 * Created by P.A.V.Saranga on 30-Oct-16.
 */
public class Travel extends AppCompatActivity {

    TableLayout tl;
    StringBuilder sb;
    String id, result, date, inStation, outStation, noOfTickets, amount;
    TextView t_date, in_Station, out_Station, noOf_Tickets, credit;
    JSONObject json_data;
    TableRow.LayoutParams lpp;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.travel);
        setConfig();
        getPrefs();
        Thread t1 = new Thread(new Runnable() {
            @Override
            public void run() {
                getResponse();
            }
        });
        t1.start();
    }

    private void setConfig() {
        tl = (TableLayout)findViewById(R.id.tlTravel);
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
        lpp = new TableRow.LayoutParams(TableRow.LayoutParams.WRAP_CONTENT);
        TableRow title= new TableRow(this);
        TextView h6 = new TextView(this);
        title.setLayoutParams(lpp);
        title.addView(h6);
        tl.addView(title, 0);
        styles(h6,"Daily Travel Information",30,5,5,5,5);
        switch(message) {
            case "EMPTY":
                newThread("Please Login To Continue.");
                TableRow error1= new TableRow(this);
                TextView e1 = new TextView(this);
                error1.setLayoutParams(lpp);
                error1.addView(e1);
                tl.addView(error1, 1);
                styles(e1,"Please Login To Continue",30,6,6,6,6);
                break;
            case "NODATA":
                newThread("No Data To Display.");
                TableRow error2= new TableRow(this);
                TextView e2 = new TextView(this);
                error2.setLayoutParams(lpp);
                error2.addView(e2);
                tl.addView(error2, 1);
                styles(e2,"No Data To Display.",30,6,6,6,6);
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
                        JSONArray array = json_data.getJSONArray("travel");
                        TableRow heading= new TableRow(this);
                        heading.setLayoutParams(lpp);
                        TextView h1 = new TextView(this);
                        TextView h2 = new TextView(this);
                        TextView h3 = new TextView(this);
                        TextView h4 = new TextView(this);
                        TextView h5 = new TextView(this);
                        styles(h1,"Date",20,5,5,5,5);
                        styles(h2,"In Station",20,5,5,5,5);
                        styles(h3,"Out Station",20,5,5,5,5);
                        styles(h4,"No Of Tickets",20,5,5,5,5);
                        styles(h5,"Amount",20,5,5,5,5);
                        heading.addView(h1);
                        heading.addView(h2);
                        heading.addView(h3);
                        heading.addView(h4);
                        heading.addView(h5);
                        tl.addView(heading, 1);
                        for(int i=0; i<array.length();i++){
                            JSONObject job = array.getJSONObject(i);
                            date = job.getString("date");
                            inStation = job.getString("inStation");
                            outStation = job.getString("outStation");
                            noOfTickets = job.getString("noOfTickets");
                            amount = job.getString("amount");
                            //set data to the table rows
                            TableRow row= new TableRow(this);
                            row.setLayoutParams(lpp);
                            t_date = new TextView(this);
                            in_Station = new TextView(this);
                            out_Station = new TextView(this);
                            noOf_Tickets = new TextView(this);
                            credit = new TextView(this);
                            styles(t_date,date,15,5,5,5,5);
                            styles(in_Station,inStation,15,5,5,5,5);
                            styles(out_Station,outStation,15,5,5,5,5);
                            styles(noOf_Tickets,noOfTickets,15,5,5,5,5);
                            styles(credit,amount,15,5,5,5,5);
                            row.addView(t_date);
                            row.addView(in_Station);
                            row.addView(out_Station);
                            row.addView(noOf_Tickets);
                            row.addView(credit);
                            tl.addView(row, i+2);
                        }
                    } catch (JSONException e) {
                        e.printStackTrace();
                    }
                } else {
                    newThread("Please Try Again Later.");
                }
        }
    }

    private void styles(TextView id,String text, int size, int left, int right, int top, int bottom) {
        id.setText(text);
        id.setTextSize(size);
        id.setPadding(left,right,top,bottom);
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