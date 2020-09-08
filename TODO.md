#TODO

* Jak dodać do statystyk (stats) nowe statystyki, statsbestsuppler jest dobrym przykładem
* Jak zrobić encje w doctrine czy tylko recznie się da?
* jak zrobic widget
* jak zrobic główne menu SELL czyli kategoria menu
* jak dodawac i edytowac reklamy
* jak dodac modul do hooka który będzie wyświetlał np. tekst lub obrazek tutaj link: http://presta.test/admin-dev/index.php/improve/design/modules/positions/?_token=bE263NHrdceAg6sTYaoyu3gCHH8b0N3n8xUwiuHAi7E
* instalacja bundle assets- o co chodzi generuje js,css image?
* poznac dobrze dzialanie themes czyli podpinanie js i css oraz strukture
* filtrowanie produktow jakis prosty controller zrobic
* jak dodać do smarty funkcje która będzie robiła ładnego var_dump-a
        ```smarty
             <pre>
            {$menu|@print_r} 
            </pre>
        ```
* do zrobienia hookmanager - ten prowizoryczny nie dokonca dziala nama przy dodawaniu nie dodaje i nie ma edycji
* dodałem debugger smarty

        ```php 
            // Smarty profile switch on/off
            if (!defined('_PS_DEBUG_PROFILING_')) {
                if (strpos($_SERVER['PHP_SELF'], 'admin-') === 1) {
                    define('_PS_DEBUG_PROFILING_', false);
                } else {
                    define('_PS_DEBUG_PROFILING_', true);
                }
            }
        ```
 * stworzyc hook ktory będzie definiował modul oraz wyswietlal szablon z themes. To chyba widget
        
        
wedkarski
- menu leve jak w allegro
- menu lewe zostaje
- menu zostaje rozbudowane lewe
- nas - kopia danych
- sciezka linka kategorii
- filtrowani jak allegro po lewej tez bedzie
- wyswietlany produkt - przy kilku wersjach produktu lista (i min fotki ) po najechaniu ma wyswietlac zdjecie lub powiekszone


ogarniete:
* jak generowac email
* jak zrobic theme email
* dodac w exampleAllegro composer.json który złapie przestrzen nazw w tej chwili wymaga grzebania w innych plikach poza modules/

