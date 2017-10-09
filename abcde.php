<form method ="POST" action="ok.php">
    <!-- i campi hidden permettono di memorizzare delle informazioni che verranno poi re-inviate al server
         questi dati sono presenti nella pagina html. TUTTI POSSONO VEDERE LOGIN E PASSWORD!!!! -->
    <input type="hidden" name="login" value="<?php echo $login;?>">
    <input type="hidden" name="password" value="<?php echo $password;?>">

    <table class="insert" border="1">
        <tr>
            <td>Nome: </td><td><input type = "text" name = "nome"></input></td>
        </tr>
        <tr>
            <td>Cognome: </td><td><input type = "text" name = "cognome"></input></td>
        </tr>
        <tr>
            <td>Data nascita: </td><td>
                giorno:
                <select name="giorno">
                    <?php

                    for($i=1;$i<=31;$i++)
                    {
                        echo "<option value='$i'>$i</option>";
                    }

                    ?>
                </select>
                mese:
                <select name="mese">
                    <?php

                    for($i=1;$i<=12;$i++)
                    {
                        echo "<option value='$i'>$i</option>";
                    }

                    ?>
                </select>
                anno:
                <select name="anno">
                    <?php

                    for($i=1970;$i<=2010;$i++)
                    {
                        echo "<option value='$i'>$i</option>";
                    }

                    ?>
                </select>


            </td>
        </tr>

        <tr>
            <td>Sesso: </td><td>
                <input type="radio" name="sex" value="m">Maschio</input>
                <input type="radio" name="sex" value="f">Femmina</input>
            </td>
        </tr>
        <tr>
            <td>Attivit‡: </td><td>

                <input type="checkbox" name="attivita[]" value="scii">Sci</input><br/>
                <input type="checkbox" name="attivita[]" value="tennis">Tennis</input><br/>
                <input type="checkbox" name="attivita[]" value="golf">Golf</input><br/>
                <input type="checkbox" name="attivita[]" value="canoa">Canoa</input><br/>
                <input type="checkbox" name="attivita[]" value="altro">Altro</input><br/>
            </td>
        </tr>

        <tr>
            <td>Condizioni di utilizzo </td><td>

                <table border="1">
                    <tr><td>bla bla bla bla bla bla bla bla bla bla bla bla
                            bla bla bla bla bla bla bla bla bla bla bla bla
                            bla bla bla bla bla bla bla bla bla bla bla bla </td></tr>
                </table>
                <input type="checkbox" name="condizioni" value="ok">Accetto</input><br/>
            </td>
        </tr>


        <tr>
            <td colspan="2" align="center"><input type= "submit" value= "OK"/>
                <input type = "reset" value = "Cancella"/>

            </td>
        </tr>
    </table>
</form>