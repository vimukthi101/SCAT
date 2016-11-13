package com.example.pavsaranga.scat;

import android.app.Activity;
import android.app.AlertDialog;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;
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
 * Created by P.A.V.Saranga on 13-Nov-16.
 */
public class Transfer_Controller extends Activity {

    Button transfer;
    TextView nic, fName, balance, cNo, contact;
    StringBuilder sb;
    String amount, fullName, id, cardNo, tel, user, result, newBalance;
    SharedPreferences sharedpreferences;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.transfer_controll);
        getConifg();
        getPrefs();
        setConfig();
    }

    private void getConifg() {
        transfer = (Button)findViewById(R.id.btnTransfer);
        nic = (TextView)findViewById(R.id.tvNic);
        fName = (TextView)findViewById(R.id.tvName);
        balance = (TextView)findViewById(R.id.tvAmount);
        cNo = (TextView)findViewById(R.id.tvCardNo);
        contact = (TextView)findViewById(R.id.tvContact);
    }

    private void getPrefs() {
        SharedPreferences userDetails = Transfer_Controller.this.getSharedPreferences("MyPrefs", Context.MODE_PRIVATE);
        amount = userDetails.getString("transferAmount", "");
        fullName = userDetails.getString("transferName", "");
        id = userDetails.getString("transferNIC", "");
        cardNo = userDetails.getString("transferCard", "");
        tel = userDetails.getString("transferContact", "");
        user = userDetails.getString("NIC", "");
    }

    private void setConfig() {
        nic.setText(id);
        fName.setText(fullName);
        balance.setText(amount);
        cNo.setText(cardNo);
        contact.setText(tel);
        transfer.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                open(v);
            }
        });
    }

    public void open(View view){
        AlertDialog.Builder alertDialogBuilder = new AlertDialog.Builder(this);
        alertDialogBuilder.setMessage("Are you sure,You want to Transfer?");
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
                Toast.makeText(Transfer_Controller.this,"Cancelled.",Toast.LENGTH_LONG).show();
                finish();
            }
        });
        AlertDialog alertDialog = alertDialogBuilder.create();
        alertDialog.show();
    }

    private void getResponse() {
        try{
            String link="http://192.168.43.73:1234/SCAT/mobile/src/transfer.php";
            String data  = URLEncoder.encode("amount", "UTF-8") + "=" + URLEncoder.encode(amount, "UTF-8");
            data += "&" + URLEncoder.encode("nic", "UTF-8") + "=" + URLEncoder.encode(id, "UTF-8");
            data += "&" + URLEncoder.encode("user", "UTF-8") + "=" + URLEncoder.encode(user, "UTF-8");
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
                newThread("Required Fields Cannot Be Empty.");
                break;
            case "WNIC":
                newThread("Wrong NIC Format.");
                break;
            case "WAMOUNT":
                newThread("Wrong Amount Format.");
                break;
            case "IUSER":
                newThread("Invalid User.");
                break;
            case "IBALANCE":
                newThread("Insufficient Balance.");
                break;
            case "ERROR":
                newThread("Please Try Again Later.");
                break;
            default:
                try {
                    JSONObject json_data = new JSONObject(message);
                    result = json_data.getString("result");
                    newBalance = json_data.getString("balance");
                } catch (JSONException e) {
                    e.printStackTrace();
                }
                if(result.equals("SUCCESS")){
                    sharedpreferences = getSharedPreferences("MyPrefs", Context.MODE_PRIVATE);
                    SharedPreferences.Editor editor = sharedpreferences.edit();
                    editor.putString("balance",newBalance);
                    editor.commit();
                    Intent intent = new Intent("com.example.pavsaranga.scat.BALANCE");
                    startActivity(intent);
                    newThread("Transfered Successfully!");
                } else {
                    newThread("No User With The Entered NIC.");
                }
                break;
        }
    }

    private void newThread(String msg) {
        final String toast = msg;
        this.runOnUiThread(new Runnable() {
            @Override
            public void run() {
                Toast.makeText(Transfer_Controller.this,toast,Toast.LENGTH_SHORT).show();
            }
        });
    }
}
