package com.example.pavsaranga.scat;

import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

/**
 * Created by P.A.V.Saranga on 03-Nov-16.
 */
public class LogIn extends AppCompatActivity {
    Button b1;
    EditText ed1,ed2;

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
                if(ed1.getText().toString().equals("admin") &&
                        ed2.getText().toString().equals("admin")) {
                    Toast.makeText(getApplicationContext(), "Redirecting...",Toast.LENGTH_SHORT).show();
                    Class loadClass = null;
                    try {
                        loadClass = Class.forName("com.example.pavsaranga.scat.Account");
                    } catch (ClassNotFoundException e) {
                        e.printStackTrace();
                    }
                    Intent loadIntent = new Intent(LogIn.this, loadClass);
                    startActivity(loadIntent);
                }
                else{
                    ed1.setText("");
                    ed2.setText("");
                    Toast.makeText(getApplicationContext(), "Wrong Credentials",Toast.LENGTH_SHORT).show();
                }
            }
        });
    }
}
