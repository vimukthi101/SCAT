package com.example.pavsaranga.scat;

import android.app.ListActivity;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.ListView;

/**
 * Created by P.A.V.Saranga on 29-Oct-16.
 */
public class Account extends ListActivity {

    String[] classes = {"View My Profile", "Check My Balance", "Share Credits", "view My Travel Info", "Block My Account", "Log Out"};

    @Override
    protected void onListItemClick(ListView l, View v, int position, long id) {
        super.onListItemClick(l, v, position, id);
        String item = classes[position];
        try{
            if(item.equals("View My Profile")){
                Class loadClass = Class.forName("com.example.pavsaranga.scat.Map");
                Intent loadIntent = new Intent(Account.this, loadClass);
                startActivity(loadIntent);
            } else if(item.equals("Check My Balance")) {
                Class loadClass = Class.forName("com.example.pavsaranga.scat.Account");
                Intent loadIntent = new Intent(Account.this, loadClass);
                startActivity(loadIntent);
            } else if(item.equals("Share Credits")) {
                Class loadClass = Class.forName("com.example.pavsaranga.scat.Account");
                Intent loadIntent = new Intent(Account.this, loadClass);
                startActivity(loadIntent);
            } else if(item.equals("view My Travel Info")) {
                Class loadClass = Class.forName("com.example.pavsaranga.scat.Account");
                Intent loadIntent = new Intent(Account.this, loadClass);
                startActivity(loadIntent);
            } else if(item.equals("Block My Account")) {
                Class loadClass = Class.forName("com.example.pavsaranga.scat.Account");
                Intent loadIntent = new Intent(Account.this, loadClass);
                startActivity(loadIntent);
            } else if(item.equals("Log Out")) {
                Class loadClass = Class.forName("com.example.pavsaranga.scat.Account");
                Intent loadIntent = new Intent(Account.this, loadClass);
                startActivity(loadIntent);
            }
        } catch(ClassNotFoundException e) {
            e.printStackTrace();
        }
    }

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setListAdapter(new ArrayAdapter<String>(Account.this, android.R.layout.simple_list_item_1, classes));
    }
}

