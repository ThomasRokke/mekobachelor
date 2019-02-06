<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.css">
    <script
            src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.js"></script>

    <script>
        $(document)
            .ready(function() {
                $('.menu .item')
                    .tab()
                ;

                $('.ui.accordion')
                    .accordion()
                ;



                $('select.dropdown')
                    .dropdown()
                ;
            })
        ;


    </script>

    <style>

        .sidebar .item{
            color:gray !important;
        }





    </style>




    <title>Semantic test</title>
</head>
<body>
<!-- Sidenav-->
<div class="ui left demo visible  vertical inverted sidebar labeled icon menu">
    <a class="item">
        <i class="home icon"></i> Hjem
    </a>
    <a class="item active">
        <i class="table layout icon a"></i> Ruter
    </a>
    <a class="item">
        <i class="wrench icon"></i> Verksteder
    </a>
    <a class="item">
        <i class="users icon"></i> Roller
    </a>

</div>
<!--End sidenav-->

<div class="ui text container">



    <div class="ui top attached tabular menu" style="margin-top:30px;">
        <a class="active item" data-tab="first">Ordre</a>

        <a class="item" data-tab="third">Hente</a>
    </div>
    <div class="ui bottom attached active tab segment" data-tab="first">
        <div class="ui form" >
            <div class="three fields">
                <div class="field">


                    <div class="ui corner labeled input">
                        <input type="text" placeholder="Kundenummer">
                        <div class="ui corner label">
                            <i class="asterisk icon red"></i>
                        </div>
                    </div>
                </div>
                <div class="field">



                    <div class="ui corner labeled input">
                        <input type="text" placeholder="Ordrenummer">
                        <div class="ui corner label">
                            <i class="asterisk icon red"></i>
                        </div>
                    </div>


                </div>
                <div class="field">

                    <!-- Add positive class on valid validation -->
                    <input class="ui  basic button" type="submit" value="Registrer ordre" placeholder="Last Name">
                </div>
            </div>

            <div class="ui accordion">
                <div class="active title">
                    <i class="dropdown icon"></i>
                    Fler valg
                </div>
                <div class="content">

                    <div class="three fields">
                        <div class="field">

                            <select class="ui search dropdown">
                                <option value="">Velg rute</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>




                            </select>
                        </div>
                        <div class="field">

                            <select class="ui search dropdown">
                                <option value="">Velg tid</option>
                                <option value="07:30">07:30</option>
                                <option value="07:30">08:00</option>
                                <option value="07:30">09:00</option>
                                <option value="07:30">12:00</option>
                                <option value="07:30">14:00</option>
                                <option value="07:30">17:30</option>



                            </select>
                        </div>
                        <div class="field">

                            <input type="date" placeholder="Dato">

                        </div>





                    </div>


                    <div class="three fields">
                        <div class="field">
                            <div class="ui test toggle checkbox" style="margin-left:80px; !important; margin-top:5px !important;">


                                <input  type="checkbox">




                            </div> <div class="ui below pointing label">
                                Skal det betales med kort eller kontant?
                            </div>

                        </div>

                        <div class="field">

                            <div class="ui corner labeled input">
                                <input type="text" placeholder="sum" id="sum"  disabled>
                                <div style="display: none"  id="input-required-disabled" class="ui corner label input-label-enabled">
                                    <i class="asterisk icon red"></i>
                                </div>
                            </div>



                        </div>
                    </div>

                </div>
            </div>

        </div>



    </div>

    <div class="ui bottom attached tab segment" data-tab="third">
        <div class="ui form" >
            <div class="three fields">
                <div class="field">

                    <div class="ui search">
                        <div class="ui left icon input corner labeled">
                            <input class="prompt" type="text" placeholder="Søk etter verksted">
                            <i class="wrench icon"></i>
                            <div class="ui corner label">
                                <i class="asterisk icon red"></i>
                            </div>
                        </div>


                    </div>

                </div>
                <div class="field">

                    <input type="text" placeholder="Kommentar">

                </div>
                <div class="field">

                    <!-- Add positive class on valid validation -->
                    <input class="ui  basic button" type="submit" value="Registrer hentemelding" placeholder="Last Name">
                </div>
            </div>

            <div class="ui accordion">
                <div class="active title">
                    <i class="dropdown icon"></i>
                    Fler valg
                </div>
                <div class="content ">

                    <div class="three fields">
                        <div class="field">

                            <select class="ui search dropdown">
                                <option value="">Velg rute</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>




                            </select>
                        </div>
                        <div class="field">

                            <select class="ui search dropdown">
                                <option value="">Velg tid</option>
                                <option value="07:30">07:30</option>
                                <option value="07:30">08:00</option>
                                <option value="07:30">09:00</option>
                                <option value="07:30">12:00</option>
                                <option value="07:30">14:00</option>
                                <option value="07:30">17:30</option>



                            </select>
                        </div>
                        <div class="field">

                            <input type="date" placeholder="Dato">

                        </div>





                    </div>



                </div>
            </div>

        </div>
    </div>

    <div class="ui section divider"></div>






</div>


<!-- Modal Kontant-->
<div class="ui modal">
    <i class="close icon"></i>
    <div class="header">
        # 83213
    </div>
    <div class="image content">
        <div class="ui medium image">
            <img src="https://d2gg9evh47fn9z.cloudfront.net/800px_COLOURBOX22409286.jpg">
        </div>
        <div class="description">
            <div class="ui header">Her skal jeg lage et oppsett for å flytte ordre osv</div>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Natus magnam quo dolor illum molestias. Odio.</p>
        </div>
    </div>
    <div class="actions">
        <div class="ui black deny button">
            Avbryt
        </div>
        <div class="ui positive right labeled icon button">
            Jeg forstår
            <i class="checkmark icon"></i>
        </div>
    </div>
</div>

<!-- End modal -->


<script type="text/javascript">
    $(document)
        .ready(function() {

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
                    minCharacters : 3,
                    apiSettings   : {
                        url        : 'http://localhost:8000/searchworkshops?q={query}',
                        onResponse : function(githubResponse) {
                            console.log(githubResponse[0].name);
                            var
                                response = {
                                    results : {}
                                }
                            ;
                            // translate GitHub API response to work with search
                            $.each(githubResponse.items, function(index, item) {

















                                response.results.push({
                                    title       : item.name,


                                });

                                console.log(response);
                            });

                            return response;
                        }
                    }
                })
            ;

        })
    ;

</script>


</body>
</html>
