@if ($errors->any())
    <script type="text/javascript">
        @foreach ($errors->all() as $error)
        $.jGrowl("{{ $error  }}", { position: 'bottom-right'});
        @endforeach
    </script>
@endif

@if(session()->has('success'))
    <script type="text/javascript">
        $.jGrowl("{{ session()->get('success')  }}", { position: 'bottom-right'});
    </script>
@endif
