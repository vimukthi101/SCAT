package com.example.pavsaranga.scat;

import android.app.AlertDialog;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;
import android.widget.Toast;

import java.io.BufferedReader;
import java.io.InputStreamReader;
import java.io.OutputStreamWriter;
import java.net.URL;
import java.net.URLConnection;
import java.net.URLEncoder;

/**
 * Created by P.A.V.Saranga on 30-Oct-16.
 */
public class Disable extends AppCompatActivity {

    TextView nic, contact, name, cardNo, regDate;
    String id, card_No, reg_Date, contact_no, full_name, fName, mName, lName;
    Button disable;
    StringBuilder sb;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.disable);
        getFields();
        getPrefs();
        setText();
    }

    private void getFields() {
        nic = (TextView)findViewById(R.id.tvNic);
        contact = (TextView)findViewById(R.id.tvContact);
        cardNo = (TextView)findViewById(R.id.tvcNo);
        regDate = (TextView)findViewById(R.id.tvReg);
        name = (TextView)findViewById(R.id.tvfName);
        disable = (Button)findViewById(R.id.btnDisable);
        disable.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                open(v);
            }
        });
    }

    private void getPrefs() {
        SharedPreferences userDetails = Disable.this.getSharedPreferences("MyPrefs", Context.MODE_PRIVATE);
        id = userDetails.getString("NIC", "");
        contact_no = userDetails.getString("contactNo", "");
        card_No = userDetails.getString("cardNo", "");
        reg_Date = userDetails.getString("regDate", "");
        fName = userDetails.getString("fName", "");
        mName = userDetails.getString("mName", "");
        lName = userDetails.getString("lName", "");
        full_name = fName + " " + mName + " " + lName;
    }

    private void setText() {
        nic.setText(id);
        cardNo.setText(card_No);
        regDate.setText(reg_Date);
        contact.setText(contact_no);
        name.setText(full_name);
    }

    public void open(View view){
        AlertDialog.Builder alertDialogBuilder = new AlertDialog.Builder(this);
        alertDialogBuilder.setMessage("Are you sure,You want to Disable?");
        alertDialogBuilder.setPositiveButton("Yes", new DialogInterface.OnClickListener() {
            @Override
            public void onClick(DialogInterface arg0, int arg1) {
                Thread t1 = new Thread(new Runnable() {
                    @Override
                    public void run() {
                        getResponse();
                    }
                });
                t1.start();
            }
        });
        alertDialogBuilder.setNegativeButton("No",new DialogInterface.OnClickListener() {
            @Override
            public void onClick(DialogInterface dialog, int which) {
                Toast.makeText(Disable.this,"Cancelled.",Toast.LENGTH_LONG).show();
            }
        });
        AlertDialog alertDialog = alertDialogBuilder.create();
        alertDialog.show();
    }

    private void getResponse() {
        try{
            String link="http://192.168.43.73:1234/SCAT/mobile/src/disable.php";
            String data  = URLEncoder.encode("nic", "UTF-8") + "=" + URLEncoder.encode(id, "UTF-8");
            data += "&" + URLEncoder.encode("status", "UTF-8") + "=" + URLEncoder.encode("0", "UTF-8");
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
        if(message.equals("SUCCESS")){
            Intent intent = new Intent("com.example.pavsaranga.scat.MENU");
            intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
            startActivity(intent);
            newThread("Disabled Successfully!");
        } else {
            newThread("Please Try Again Later.");
        }
    }

    private void newThread(String msg) {
        final String toast = msg;
        this.runOnUiThread(new Runnable() {
            @Override
            public void run() {
                Toast.makeText(Disable.this,toast,Toast.LENGTH_SHORT).show();
            }
        });
    }
}