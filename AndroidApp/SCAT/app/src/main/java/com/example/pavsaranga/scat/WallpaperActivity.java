package com.example.pavsaranga.scat;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;

public class WallpaperActivity extends Activity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_wallpaper);
        Thread timer = new Thread(){
            public void run(){
                try {
                    sleep(5000);
                } catch (InterruptedException e){
                    e.printStackTrace();
                } finally {
                    Intent next = new Intent("com.example.pavsaranga.scat.MENU");
                    startActivity(next);
                }
            }
        };
        timer.start();
    }
}
