

table genres {
id "bigint unsigned" [pk, not null, increment]
 name varchar(255) [not null]
 created_at datetime [null]
 updated_at datetime [null]
 }
 alter table genres add unique genres_name_unique(name)




table authors {
id "bigint unsigned" [pk, not null, increment]
 name varchar(255) [not null]
 birth_year int [null]
 death_year int [null]
 created_at datetime [null]
 updated_at datetime [null]
 }



table publishers {
id "bigint unsigned" [pk, not null, increment]
 name varchar(255) [not null]
 created_at datetime [null]
 updated_at datetime [null]
 }



table books {
id "bigint unsigned" [pk, not null, increment]
 title varchar(255) [not null]
 subtitle varchar(255) null
 description text [null]
 language varchar(255) [not null]
 price double(82) [not null]
 sold "int unsigned" [not null]
 quantity "int unsigned" [not null]
 image varchar(255) [null]
 weight varchar(255) [null]
 width varchar(255) [null]
 height varchar(255) [null]
 length varchar(255) [null]
 pages "int unsigned" [null]
 isbn varchar(255) [not null]
 year "int unsigned" [null]
 genre_id [bigint, unsigned, not null]
 author_id [bigint, unsigned, not null]
 publisher_id [bigint, unsigned, not null]
 rating_1 "int unsigned" [not null]
 rating_2 "int unsigned" [not null]
 rating_3 "int unsigned" [not null]
 rating_4 "int unsigned" [not null]
 rating_5 "int unsigned" [not null]
 created_at timestamp [null]
 updated_at timestamp [null]
 }
 Ref : books.genres_id > genres.id



Ref : books.authors_id > authors.id
Ref : books.publishers_id > publishers.id

table Sales {
    id "bigint unsigned" [pk, not null, increment]
    book_id "bigint unsigned" [not null]
    percentage double(82) [not null]
    until datetime [not null]
    created_at timestamp [null]
    updated_at timestamp [null]
}
 Ref : Sales.books_id > books.id