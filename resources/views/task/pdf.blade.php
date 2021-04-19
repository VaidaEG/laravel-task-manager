<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>{{$task->name}}</title>
        <style>
            @font-face {
            font-family: 'Roboto';
            font-style: normal;
            font-weight: 400;
            src: url({{ asset('fonts/Roboto-Regular.ttf') }});
            }
            @font-face {
            font-family: 'Roboto';
            font-style: normal;
            font-weight: bold;
            src: url({{ asset('fonts/Roboto-Bold.ttf') }});
            }
            body {
                font-family: 'Roboto';
            }
        </style>
    </head>
    <body>
        <h1 style="text-align: center;">{{$task->task_name}}</h1>
        <h3>{{$task->taskStatus->name}}</h3>
        <p>Created: {{$task->add_date}}</p>
        <p>Deadline: {{$task->completed_date}}</p>
        <p style="text-align: center;">{!!$task->task_description!!}</p>
    </body>
</html>
