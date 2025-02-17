@include('layouts.header')

<body>
	<div class="splash">
		<div class="splash-icon"></div>
	</div>

    <div class="wrapper">

        @include('layouts.sidebar');

    <div class="main">

        @include('layouts.navbar');

        @yield('main-section');

@include('layouts.header');