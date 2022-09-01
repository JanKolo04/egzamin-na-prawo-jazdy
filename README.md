# egzamin-na-prawo-jazdy
Strona z pytaniami na egzamin teoretyczny na prawo jazdy

## Urywki kodu

### Funkcja wykrywania błędu
Jeśli warunek wykryje, że plik `$_COOKIE` jest pusty to wywołuję błąd. ten plik Cookie jest pusty wtedy kiedy ktoś wszedł na strone bez logowania
```php
//user id
$Id_user = $_COOKIE['Id_user'];

//if id_user cookie is null move into error page
if($Id_user == null) {
  //set error cookie to show error page
  header("Location: index.php?strona=error-page/oups&previous={$_GET['strona']}");
}
```
## Strona 404
Strona 404 zawiera animacje drzewa napis i przycisk który przenosi do storny na której byliśmy wcześniej
<img width="700" alt="Zrzut ekranu 2022-08-28 o 21 27 35" src="https://user-images.githubusercontent.com/76879087/187091183-1ecaab39-bc5a-4740-bd3c-6bac989d0702.png">



## To do
- [x] Dodać do funckji warunek jeśli wykryje błąd to `header("...: index.php?strona=error-page/oups&previous=main");`
- [ ] Gdy wchodzimy na strone z nauka i wybierzemy kat.B to żeby pokazywały się pytania z kat.B
- [ ] Dodać kolumne ID_pytania do tabel z pytaniami, czyli jeszce raz zaimportować całe pytania wraz z kolumną pytanie_Id


