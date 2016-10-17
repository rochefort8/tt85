#!/bin/sh

#set -x

folder_id=""
customer_type=""
customer_id="123"
customer_lastname="Yuji"
customer_firstname=""
customer_lastname_ruby="AAA"
customer_firstname_ruby=""
customer_juniorhighschool=""
customer_club=""
customer_couple=""
customer_role=""
customer_postcode="2760022"
customer_address=""
customer_addressruby=""
customer_phone=""
customer_graduate=""
customer_mobile=""
customer_email="ogihara@gmail.com"
customer_gender=""
customer_comment=""
customer_role=""
customer_annualfee=""

n=0;
cat $1 | while read l
do
    customer_graduate=$(echo $l|cut -d, -f1)
    customer_id=$(echo $l|cut -d, -f3)

    customer_name=$(echo $l|cut -d, -f4)

    customer_lastname=$(echo $customer_name | cut -d'　' -f1)
    customer_firstname=$(echo $customer_name | cut -d'　' -f2)

    customer_name_ruby=$(echo $l|cut -d, -f5)
    customer_lastname_ruby=$(echo $customer_name_ruby | cut -d' ' -f1) 
    customer_firstname_ruby=$(echo $customer_name_ruby | cut -d' ' -f2) 

    customer_gender=$(echo $l|cut -d, -f6)
    customer_postcode=$(echo $l|cut -d, -f7)
    customer_address=$(echo $l|cut -d, -f8-11 | tr -d ',')
    customer_addressruby=""
    customer_phone=$(echo $l|cut -d, -f12)
    customer_mobile=""
    customer_email=$(echo $l|cut -d, -f13)
    customer_juniorhighschool=$(echo $l|cut -d, -f15)
    customer_club=$(echo $l|cut -d, -f14)
    customer_couple=""
    customer_role=$(echo $l|cut -d, -f21)
    customer_annualfee=""
    customer_comment=$(echo $l|cut -d, -f22)

docker exec tt-server mysql -uroot db -e "INSERT INTO customer_customer ( folder_id,customer_type,customer_id,customer_lastname,customer_firstname,customer_lastname_ruby,customer_firstname_ruby,customer_gender,customer_graduate,customer_email,customer_phone,customer_mobile,customer_postcode,customer_address,customer_addressruby,customer_juniorhighschool,customer_club,customer_couple,customer_role,customer_annualfee,customer_party,customer_comment) VALUES ('$folder_id','$customer_type','$customer_id','$customer_lastname','$customer_firstname','$customer_lastname_ruby','$customer_firstname_ruby','$customer_gender','$customer_graduate','$customer_email','$customer_phone','$customer_mobile','$customer_postcode','$customer_address','$customer_addressruby','$customer_juniorhighschool','$customer_club','$customer_couple','$customer_role','$customer_annualfee','$customer_party','$customer_comment')" 


echo $customer_id : $customer_lastname/$customer_firstname : $customer_lastname_ruby/$customer_firstname_ruby : $customer_address 
done


