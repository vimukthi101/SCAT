package com.example.pavsaranga.scat;

import android.app.Activity;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
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
 * Created by P.A.V.Saranga on 03-Nov-16.
 */
public class LogIn extends Activity {
    Button b1;
    EditText ed1,ed2;
    String uName, pwd, result, nic, fName, mName, lName, aNo, aLane, aCity, contactNo, cardNo, regDate, balance;
    StringBuilder sb;
    SharedPreferences sharedpreferences;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.login);
        b1=(Button)findViewById(R.id.btnLogin);
        ed1=(EditText)findViewById(R.id.etNicLogin);
        ed2=(EditText)findViewById(R.id.etPwd);
        b1.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
            uName = ed1.getText().toString().trim();
            pwd = ed2.getText().toString().trim();
            Thread t1 = new Thread(new Runnable() {
                @Override
                public void run() {
                    loginActivity();
                }
            });
            t1.start();
            }
        });
    }

    private void loginActivity() {
        try{
            String link="http://192.168.43.73:1234/SCAT/mobile/src/login.php";
            String data  = URLEncoder.encode("userNIC", "UTF-8") + "=" + URLEncoder.encode(uName, "UTF-8");
            data += "&" + URLEncoder.encode("password", "UTF-8") + "=" + URLEncoder.encode(pwd, "UTF-8");
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
            case "NIC":
                newThread("Wrong NIC Format.");
                break;
            case "NONIC":
                newThread("Invalid User.");
                break;
            case "PASSWORD":
                newThread("Wrong Password Format.");
                break;
            case "DISABLED":
                newThread("Your Account Is Disabled.");
                break;
            case "DEACTIVATED":
                newThread("Account Deactivated.");
                break;
            case "ERROR":
                newThread("Please Try Again Later.");
                break;
            case "INCORRECT":
                newThread("Login Failed.");
                break;
            default:
                try {
                    //get json data
                    JSONObject json_data= new JSONObject(message);
                    result = json_data.getString("result");
                    nic = json_data.getString("nic");
                    fName = json_data.getString("fName");
                    mName = json_data.getString("mName");
                    lName = json_data.getString("lName");
                    aNo = json_data.getString("aNo");
                    aCity = json_data.getString("city");
                    aLane = json_data.getString("lane");
                    contactNo = json_data.getString("contact");
                    regDate = json_data.getString("regDate");
                    balance = json_data.getString("balance");
                    cardNo = json_data.getString("cardNo");
                } catch (JSONException e) {
                    e.printStackTrace();
                }
                if(!result.isEmpty() && result.equals("SUCCESS")){
                    newThread("Login Successfull.");
                    //create my preferences
                    sharedpreferences = getSharedPreferences("MyPrefs", Context.MODE_PRIVATE);
                    SharedPreferences.Editor editor = sharedpreferences.edit();
                    editor.clear();
                    editor.putString("NIC",nic);
                    editor.putString("fName",fName);
                    editor.putString("mName",mName);
                    editor.putString("lName",lName);
                    editor.putString("aNo",aNo);
                    editor.putString("lane",aLane);
                    editor.putString("city",aCity);
                    editor.putString("contactNo",contactNo);
                    editor.putString("regDate",regDate);
                    editor.putString("cardNo",cardNo);
                    editor.putString("balance",balance);
                    editor.commit();
                    //start next page
                    Intent myApp = new Intent("com.example.pavsaranga.scat.ACCOUNT");
                    startActivity(myApp);
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
                Toast.makeText(LogIn.this,toast,Toast.LENGTH_SHORT).show();
            }
        });
    }
}
