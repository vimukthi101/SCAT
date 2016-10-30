package com.example.pavsaranga.scat;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.ImageButton;

/**
 * Created by P.A.V.Saranga on 29-Oct-16.
 */
public class Account extends Activity {

    private ImageButton btn1, btn2, btn3, btn4, btn5, btn6;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.account);
        setUp();
    }

    protected void setUp(){
        btn1 = (ImageButton) findViewById(R.id.button01);
        btn2 = (ImageButton) findViewById(R.id.button02);
        btn3 = (ImageButton) findViewById(R.id.button03);
        btn4 = (ImageButton) findViewById(R.id.button04);
        btn5 = (ImageButton) findViewById(R.id.button05);
        btn6 = (ImageButton) findViewById(R.id.button06);
        btn1.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent i1 = new Intent("com.example.pavsaranga.scat.PROFILE");
                startActivity(i1);
            }
        });
        btn2.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent i2 = new Intent("com.example.pavsaranga.scat.BALANCE");
                startActivity(i2);
            }
        });
        btn3.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent i3 = new Intent("com.example.pavsaranga.scat.TRAVEL");
                startActivity(i3);
            }
        });
        btn4.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent i4 = new Intent("com.example.pavsaranga.scat.TRANSFER");
                startActivity(i4);
            }
        });
        btn5.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent i5 = new Intent("com.example.pavsaranga.scat.DISABLE");
                startActivity(i5);
            }
        });
        btn6.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent i6 = new Intent("com.example.pavsaranga.scat.LOGOUT");
                startActivity(i6);
            }
        });
    }
}

