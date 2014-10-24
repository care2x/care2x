<?xml version="1.0"?>
<query>
    <select>care_person.pid, care_person.name_first, care_person.name_last, care_person.date_birth, care_person.blood_group, care_person.addr_str, care_person.addr_str_nr, care_person.sex, care_person.sss_nr, care_person.date_reg, care_person_insurance.insurance_nr, care_person_insurance.`type`, care_person_insurance.firm_id, care_person.create_id</select>
    <from>care_person   LEFT OUTER JOIN care_person_insurance ON (care_person.pid = care_person_insurance.pid)</from>
    <where></where>
    <groupby></groupby>
    <orderby></orderby>
</query>