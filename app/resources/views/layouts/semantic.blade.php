<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="shortcut icon" href="https://www.mekonomen.se/favicon.ico?v=2">

    <link rel="icon" href="https://www.mekonomen.se/favicon.ico?v=2">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.css">


    <script
            src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.js"></script>

    @yield('header')




    <title>Kjørekontoret </title>
</head>
<body>


    <!-- Nav -->
    <div class="ui fixed inverted large menu">
        <a href="#" class="item open button">
            <i class="sidebar icon"></i>
            Meny
        </a>

        <div class="ui container text">
            <div class="header item meko-color-text" style="border-left:none!important">
                Mekodrive
            </div>
            <div class="left menu">
                <div class="ui left aligned category search item">
                    <div class="ui transparent inverted icon input">
                        <input class="prompt" type="text" placeholder="Søk etter verksteder">
                        <i class="search link icon"></i>
                    </div>
                    <div class="results"></div>
                </div>
                <div class="ui left aligned category search item">
                    <div class="ui transparent inverted icon input">
                        <input class="prompt" type="text" placeholder="Søk etter ordrenummer">
                        <i class="search link icon"></i>
                    </div>
                    <div class="results"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- End nav -->
    <!-- Sidenav-->
    <div id="sidenav" class="ui left demo inverted  vertical  sidebar labeled icon menu ">
        <a href="{{ route('getorders') }}" class="item">
            <i class="database icon"></i> Datauthenting
        </a>
        <a href="{{ route('proto.prototest') }}" class="item active">
            <i class="table layout icon a"></i> Ruter
        </a>
        <a href="{{ route('proto.protoworkshop') }}" class="item">
            <i class="wrench icon"></i> Verksteder
        </a>
        <a href="{{ route('proto.protoroles') }}" class="item">
            <i class="users icon"></i> Brukere
        </a>
    </div>
    <!--End sidenav-->



<article>
    @yield('content')

</article>


<footer style="margin-top:500px">
    <div class="ui inverted vertical footer segment">
        <div class="ui center aligned container">
            <div class="ui stackable inverted divided grid">
                <div class="three wide column">
                    <h4 class="ui inverted header">Lorem</h4>
                    <div class="ui inverted link list">
                        <a href="#" class="item">Link One</a>
                        <a href="#" class="item">Link Two</a>
                    </div>
                </div>
                <div class="three wide column">
                    <h4 class="ui inverted header">Lorem</h4>
                    <div class="ui inverted link list">
                        <a href="#" class="item">Lorem</a>
                        <a href="#" class="item">Lorem</a>
                    </div>
                </div>
                <div class="three wide column">
                    <h4 class="ui inverted header">Lorem</h4>
                    <div class="ui inverted link list">
                        <a href="#" class="item">Lorem</a>
                        <a href="#" class="item">Lorem</a>
                    </div>
                </div>
                <div class="seven wide column">
                    <h4 class="ui inverted header">Om Mekodrive</h4>
                    <p>Lorem ipsum dolor sit amet,<br> consectetur adipisicing elit. Natus, quia?</p>
                </div>
            </div>
            <div class="ui inverted section divider"></div>
            <img src="https://www.mekonomen.no/Content/images/mekonomen-logo.svg" class="ui centered image">
            <div class="ui horizontal inverted small divided link list">
                <a class="item" href="#">Sidekart</a>
                <a class="item" href="#">Kontakt IT</a>
                <a class="item" href="#">Personvern</a>
            </div>
            <div class="ui inverted section">
                <div class="ui horizontal inverted small divided link list">
                    <p>Copyright or something?</p>
                </div>
            </div>
        </div>
    </div>
</footer>
<script type="text/javascript">
    $(document)
        .ready(function() {

            $(document).keydown(function(e){
                if (e.which == 40) {
                    //TODO: Create code to expand
                    console.log('down');
                    $(".ui.accordion.order").accordion('open', 0);
                    return false;
                }/*else if(e.which == 38){

                   $(".ui.accordion.order").accordion('close', 0);
              } */
            });
            //Focus on page load
            $("#kundenummer").focus();


            $("#kundenummer").change(function(e){
                var val = e.target.value;
                $.ajax({url: "http://localhost:8000/getworkshopinfo?q="+val, success: function(response){

                        if(response.id > 0){
                            console.log(e.target);
                            $("#kundenummer").css("border-color", "green");
                            $("#kundenummer-label").text(response.name).show();


                        }else{
                            $("#kundenummer").css("border-color", "red");
                            $("#kundenummer-label").text("Det eksisterer ikke et verksted med det kundenummeret.").show();
                        }
                    }});
            });

            $('.ui.checkbox')
                .checkbox()
                .first().checkbox({
                onChecked: function() {
                    console.log('checked');
                    document.getElementById('sum').disabled = false;
                    $("#input-required-disabled").show().focus();
                },
                onUnchecked: function() {
                    console.log('unchecked');
                    document.getElementById('sum').disabled = true;
                    document.getElementById('sum').value = null;
                    $("#input-required-disabled").hide();
                },
                onEnable: function() {
                    console.log('onenable');
                },
                onDisable: function() {
                    console.log('ondisable');
                },
                onDeterminate: function() {
                    console.log('ondeterminate');
                },
                onIndeterminate: function() {
                    console.log('onindeterminate');
                },
                onChange: function() {
                    console.log('on change');
                }
            })
            ;
            // bind events to buttons
            $('.callback.example .button')
                .on('click', function() {
                    $('.callback .checkbox').checkbox( $(this).data('method') );
                })
            ;


            $('.ui.search')
                .search({
                    type          : 'category',
                    minCharacters : 3,
                    apiSettings   : {
                        onResponse: function(githubResponse) {
                            var count = Object.keys(githubResponse).length;
                            console.log(count);
                            var
                                response = {
                                    results : {}
                                }
                            ;

                            for(var i = 0; i < count; i++){

                                var objectPart = githubResponse[i];

                                console.log(objectPart);
                                var
                                    language   = 'Verksted',
                                    maxResults = 8
                                ;
                                if(i >= maxResults) {

                                    return false;
                                }
                                // create new language category
                                if(response.results[language] === undefined) {
                                    response.results[language] = {
                                        name    : language,
                                        results : []
                                    };
                                }
                                // add result to category
                                response.results[language].results.push({
                                    title       : objectPart.name,
                                    description : objectPart.description,
                                    url         : objectPart.html_url
                                });
                            }


                            return response;
                        },
                        url: '//localhost:8000/searchworkshops?q={query}'
                    }
                })
            ;


        })
    ;

</script>


@yield('bottom-scripts')
</body>
</html>
