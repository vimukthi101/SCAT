package com.example.pavsaranga.scat;

import android.content.Context;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.widget.TextView;

/**
 * Created by P.A.V.Saranga on 30-Oct-16.
 */
public class Balance extends AppCompatActivity {

    TextView nic, contact, balance, cardNo, regDate;
    String id, card_No, reg_Date, contact_no, credit;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.balance);
        getFields();
        getPrefs();
        setText();
    }

    private void getFields() {
        nic = (TextView)findViewById(R.id.tvNic);
        contact = (TextView)findViewById(R.id.tvContact);
        cardNo = (TextView)findViewById(R.id.tvcNo);
        regDate = (TextView)findViewById(R.id.tvReg);
        balance = (TextView)findViewById(R.id.tvBalance);
    }

    private void getPrefs() {
        SharedPreferences userDetails = Balance.this.getSharedPreferences("MyPrefs", Context.MODE_PRIVATE);
        id = userDetails.getString("NIC", "");
        contact_no = userDetails.getString("contactNo", "");
        card_No = userDetails.getString("cardNo", "");
        reg_Date = userDetails.getString("regDate", "");
        credit = userDetails.getString("balance", "");
    }

    private void setText() {
        nic.setText(id);
        cardNo.setText(card_No);
        regDate.setText(reg_Date);
        contact.setText(contact_no);
        balance.setText(credit);
    }
}
