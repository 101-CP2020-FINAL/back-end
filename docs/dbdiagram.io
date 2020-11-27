//// https://dbdiagram.io

Table tbl_okpdtr {
  okpdtr int [pk]
  title varchar
}

Table tbl_okved {
  okved varchar [pk]
  title varchar
}

Table tbl_vacancies {
  id int [pk, increment]
  created_by int [not null]
  created_at int
  okpdtr int [not null]
  okved varchar [not null]
  kladr bigint [not null]
  number int
  month_year int
}

Ref: tbl_vacancies.okpdtr > tbl_okpdtr.okpdtr
Ref: tbl_vacancies.okved > tbl_okved.okved
Ref: tbl_vacancies.created_by > tbl_hirer.id
Ref: tbl_vacancies.kladr > tbl_municipality.kladr

Table tbl_predictions {
  id int [pk, increment]
  okpdtr int [not null]
  created_at int
  3_months_value int
  6_months_value int
  12_months_value int
}

Ref: tbl_predictions.okpdtr > tbl_okpdtr.okpdtr

Table tbl_hirer {
  id int [pk, increment]
  title varchar
}

Table tbl_seekers {
  id int [pk, increment]
  inn int
  snils varchar
  sex tinyint
  birthday_date int
  kladr bigint
  date_created int
  date_closed int
  reason int
}

Ref: tbl_seekers.kladr > tbl_municipality.kladr
Ref: tbl_seekers.reason > tbl_reason.id

Table tbl_seekers_rel_okpdtr {
  id int [pk, increment]
  seeker_id int [not null]
  okpdtr int [not null]
}

Ref: tbl_seekers_rel_okpdtr.seeker_id > tbl_seekers.id
Ref: tbl_seekers_rel_okpdtr.okpdtr > tbl_okpdtr.okpdtr

Table tbl_municipality {
  id int [pk, increment]
  kladr bigint [not null]
  title varchar [not null]
}

Table tbl_reason {
  id int [pk, increment]
  title varchar [not null]
}
