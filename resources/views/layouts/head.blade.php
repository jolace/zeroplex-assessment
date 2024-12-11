<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>{{ config('app.name', 'Task Manager') }}</title>
<link  rel="stylesheet" type="text/css" href="{{URL::to('/bootstrap/css/bootstrap.min.css')}}"/>
<link  rel="stylesheet" type="text/css" href="{{URL::to('/jstable/jstable.css')}}"/>
<link  rel="stylesheet" type="text/css" href="{{URL::to('/fontawesome/css/all.min.css')}}"/>
<link  rel="stylesheet" type="text/css" href="{{URL::to('/css/custom.css')}}"/>
<link  rel="stylesheet" type="text/css" href="{{URL::to('/css/notyf.css')}}"/>
<script src="{{URL::to('/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{URL::to('/jstable/jstable.min.js')}}"></script>
<script src="{{URL::to('/js/notyf.js')}}"></script>
<script type="module" src="{{URL::to('/js/taskTable.js')}}"></script>
<script type="module" src="{{URL::to('/js/task.js')}}"></script>