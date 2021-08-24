# CloudApp
Proyecto realizado con programación en hilos (arbolés)... permite la gestión indeterminada de carpetas y subcarpetas, como la indexación de cualquier archivo (Jpg, Doc, Pdf etc...) Vue Y Laravel (SPA) + API REST V1 (consumer)

## Importante
Para poder correr este proyecto de forma exitosa necesita: 
- Composer V2.1.16
- Maria DB 10.4 ^ o MySQL 8.0 ^
- Php Version 7.4 con Open Ssl y extensiones DB
- Jetstream
- NPM (Node Js v14^)

## Nota
La aplicación cumple con la mayoria de los requisitos planteados. Como la gestión indeterminada de carpetas y subcarpetas el consumo de la misma con Vue JS, como también la creación de la API rest versión 1... Sin embargo por cuestiones de tiempo quedo pendiente de subir en las proximas horas la autenticación por el numero de identificación y sus sedders y como valor adicional se agrego crud para la subida de archivos, asi como también la creación de una pequeña app con Ionic.

## Comandos para iniciar
cd nube
Php artisan Optimize:clear
npm install && npm run dev
Php artisan:migrate

## Carpetas
![alt text](https://github.com/paternostroleonardo/CloudApp/blob/main/principal.PNG)
![alt text](https://github.com/paternostroleonardo/CloudApp/blob/main/subcarpeta1.PNG)
![alt text](https://github.com/paternostroleonardo/CloudApp/blob/main/subcarpetadesubcarpeta.PNG)
![alt text](https://github.com/paternostroleonardo/CloudApp/blob/main/result.PNG)
