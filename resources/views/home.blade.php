<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <script src="{{asset('js/jquery.min.js')}}"></script>
        <style type="text/css">
            div.heading {
                margin: 0 auto;
                text-align: center;
                font-size: 40px;
                font-weight: 600;
                padding: 25px;
            }
            table {
                font-size: 30px
            }
            td {
                padding: 25px
            }
        </style>
    </head>
    <body>
        <div class="heading">List of employees </div>
        <table>
            <thead>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Joined</th>
            </thead>
            <tbody id="employee-list"></tbody>
        </ul>

        <script type="text/javascript">
            $(document).ready(()=>{
                var limit = 10;
                var offset = 0;

                function loadMoreRecords(argument) {
                    $.ajax({
                        url: '{{route('get_employees')}}',
                        type: 'GET',
                        data: {limit: limit, offset: offset},
                        success : (response)=>{
                            // console.log(response);
                            let html = '';
                                response.forEach((data,i)=>{    
                                html += `
                                    <tr>
                                        <td>${data.id}</td>
                                        <td>${data.name}</td>
                                        <td>${data.email}</td>
                                        <td>${new Date(data.created_at).toDateString()}</td>
                                    </tr>
                                `
                            });
                            $('#employee-list').append(html);
                            offset += limit;
                        }
                    })
                }

                loadMoreRecords();

                $(window).scroll(()=>{
                    if($(window).scrollTop() + $(window).height() == $(document).height()){
                        loadMoreRecords();
                    }
                })
            })
        </script>
    </body>
</html>
