package com.example.pavsaranga.scat;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
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
public class Transfer extends AppCompatActivity {

    EditText nic, amount;
    String id, credit, tFName, result, toNIC, toCNo, toContact, tofName, tolName, tosName, myNic;
    Button search;
    StringBuilder sb;
    SharedPreferences sharedpreferences;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.transfer);
        nic = (EditText) findViewById(R.id.etNic);
        amount = (EditText)findViewById(R.id.etAmount);
        search = (Button)findViewById(R.id.btnSearch);
        SharedPreferences userDetails = Transfer.this.getSharedPreferences("MyPrefs", Context.MODE_PRIVATE);
        myNic = userDetails.getString("NIC", "");
        search.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                id = nic.getText().toString().trim();
                credit = amount.getText().toString().trim();
                if(myNic.equals(id)){
                    Toast.makeText(Transfer.this,"NIC Cannot Be Yours.",Toast.LENGTH_SHORT).show();
                } else {
                    Thread t1 = new Thread(new Runnable() {
                        @Override
                        public void run() {
                            getResponse();
                        }
                    });
                    t1.start();
                }
            }
        });
    }

    private void getResponse() {
        try{
            String link="http://192.168.43.73:1234/SCAT/mobile/src/findCommuter.php";
            String data  = URLEncoder.encode("nic", "UTF-8") + "=" + URLEncoder.encode(id, "UTF-8");
            data += "&" + URLEncoder.encode("amount", "UTF-8") + "=" + URLEncoder.encode(credit, "UTF-8");
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
        switch (message){
            case "ERROR":
                newThread("Please Try Again Later.");
                break;
            default:
                try {
                    JSONObject json_data = new JSONObject(message);
                    result = json_data.getString("result");
                    toNIC = json_data.getString("nic");
                    toCNo = json_data.getString("cardNo");
                    tofName = json_data.getString("fName");
                    tosName = json_data.getString("mName");
                    tolName = json_data.getString("lName");
                    tFName = tofName + " " + tosName + " " + tolName;
                    toContact = json_data.getString("contact");
                } catch (JSONException e) {
                    e.printStackTrace();
                }
                if(result.equals("SUCCESS")){
                    sharedpreferences = getSharedPreferences("MyPrefs", Context.MODE_PRIVATE);
                    SharedPreferences.Editor editor = sharedpreferences.edit();
                    editor.putString("transferAmount",credit);
                    editor.putString("transferNIC",toNIC);
                    editor.putString("transferName",tFName);
                    editor.putString("transferCard",toCNo);
                    editor.putString("transferContact",toContact);
                    editor.commit();
                    Intent intent = new Intent("com.example.pavsaranga.scat.TRANSFER_CONTROLLER");
                    startActivity(intent);
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
                Toast.makeText(Transfer.this,toast,Toast.LENGTH_SHORT).show();
            }
        });
    }
}