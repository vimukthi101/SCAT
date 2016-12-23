package com.example.pavsaranga.gps;

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

    String[] classes = {"Settings","My Location"};

    @Override
    protected void onListItemClick(ListView l, View v, int position, long id) {
        super.onListItemClick(l, v, position, id);
        String item = classes[position];
        try{
            if(item.equals("Settings")){
                Class loadClass = Class.forName("com.example.pavsaranga.gps.Settings");
                Intent loadIntent = new Intent(Menu.this, loadClass);
                startActivity(loadIntent);
            } else if(item.equals("My Location")) {
                Class loadClass = Class.forName("com.example.pavsaranga.gps.Map");
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
