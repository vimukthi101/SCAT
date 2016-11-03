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
public class Menu extends ListActivity {

    String[] classes = {"Train Tracker", "My Account"};

    @Override
    protected void onListItemClick(ListView l, View v, int position, long id) {
        super.onListItemClick(l, v, position, id);
        String item = classes[position];
        try{
            if(item.equals("Train Tracker")){
                Class loadClass = Class.forName("com.example.pavsaranga.scat.Map");
                Intent loadIntent = new Intent(Menu.this, loadClass);
                startActivity(loadIntent);
            } else if(item.equals("My Account")) {
                Class loadClass = Class.forName("com.example.pavsaranga.scat.LogIn");
                Intent loadIntent = new Intent(Menu.this, loadClass);
                startActivity(loadIntent);
            }
        } catch(ClassNotFoundException e) {
            e.printStackTrace();
        }
    }

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setListAdapter(new ArrayAdapter<String>(Menu.this, android.R.layout.simple_list_item_1, classes));
    }
}
