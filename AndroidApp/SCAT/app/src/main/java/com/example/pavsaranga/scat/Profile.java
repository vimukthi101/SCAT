package com.example.pavsaranga.scat;

import android.content.Context;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.widget.TextView;

/**
 * Created by P.A.V.Saranga on 30-Oct-16.
 */
public class Profile extends AppCompatActivity {

    TextView nic, fName, mName, lName, aNo, city, lane, contact, cardNo, regDate;
    String id, f_Name, l_Name, m_Name, a_No, a_Lane, a_City,card_No, reg_Date, contact_no;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.profile);
        getFields();
        getPrefs();
        setText();
    }

    private void getFields() {
        nic = (TextView)findViewById(R.id.tvNic);
        fName = (TextView)findViewById(R.id.tvfName);
        mName = (TextView)findViewById(R.id.tvMname);
        lName = (TextView)findViewById(R.id.tvLname);
        aNo = (TextView)findViewById(R.id.tvAdNo);
        city = (TextView)findViewById(R.id.tvCity);
        lane = (TextView)findViewById(R.id.tvLane);
        contact = (TextView)findViewById(R.id.tvContact);
        cardNo = (TextView)findViewById(R.id.tvcNo);
        regDate = (TextView)findViewById(R.id.tvReg);
    }

    private void getPrefs() {
        SharedPreferences userDetails = Profile.this.getSharedPreferences("MyPrefs", Context.MODE_PRIVATE);
        id = userDetails.getString("NIC", "");
        f_Name = userDetails.getString("fName", "");
        m_Name = userDetails.getString("mName", "");
        l_Name = userDetails.getString("lName", "");
        contact_no = userDetails.getString("contactNo", "");
        a_No = userDetails.getString("aNo", "");
        a_Lane = userDetails.getString("lane", "");
        a_City = userDetails.getString("city", "");
        card_No = userDetails.getString("cardNo", "");
        reg_Date = userDetails.getString("regDate", "");
    }

    private void setText() {
        nic.setText(id);
        fName.setText(f_Name);
        mName.setText(m_Name);
        lName.setText(l_Name);
        aNo.setText(a_No);
        lane.setText(a_Lane);
        city.setText(a_City);
        cardNo.setText(card_No);
        regDate.setText(reg_Date);
        contact.setText(contact_no);
    }
}