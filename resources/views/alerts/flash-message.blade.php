
@if ($message = Session::get('success'))
        

        <div class="content-body">


                           <!-- Alert Colors start -->
            <section id="alert-colors">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                
                                <div class="card-body">
                                  
                                        <div class="alert alert-success" role="alert">
                                            <h4 class="alert-heading">Success</h4>
                                            <div class="alert-body">
                                            {{ $message }}
                                            </div>
                                        </div>  
                                </div>
                            </div>
                        </div>
                    </div>
            </section>
                
        
        </div>
    
@endif
  
@if ($message = Session::get('error'))
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow">

    </div>
    <div class="content-wrapper">

        <div class="content-body">


                           <!-- Alert Colors start -->
                <section id="alert-colors">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                
                                <div class="card-body">
                                  
                                    <div class="demo-spacing-0">
                                        <div class="alert alert-danger" role="alert">
                                            <h4 class="alert-heading">Danger</h4>
                                            <div class="alert-body">
                                                @php echo $message; @endphp
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
        </div>   
                
    </div>
@endif
   
@if ($message = Session::get('warning'))
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">

            <div class="content-body">


                           <!-- Alert Colors start -->
                           <section id="alert-colors">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                
                                <div class="card-body">
                                  
                                    <div class="demo-spacing-0">
                                        <div class="alert alert-warning" role="alert">
                                            <h4 class="alert-heading">Warning</h4>
                                            <div class="alert-body">
                                                @foreach($message as $m)
                                                    {{$m}}
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                
                
        </div>
</div>
@endif
   
@if ($message = Session::get('info'))
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">

            <div class="content-body">


                           <!-- Alert Colors start -->
                           <section id="alert-colors">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                
                                <div class="card-body">
                                  
                                    <div class="demo-spacing-0">
<div class="alert alert-info" role="alert">
                                            <h4 class="alert-heading">Info</h4>
                                            <div class="alert-body">
                                                {{$message}}
                                            </div>
                                        </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                
                
</div>
</div>
@endif
  
@if ($errors->any())
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">

            <div class="content-body">


                           <!-- Alert Colors start -->
                           <section id="alert-colors">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                
                                <div class="card-body">
                                  
                                    <div class="demo-spacing-0">
<div class="alert alert-danger" role="alert">
                                            <h4 class="alert-heading">Maybe some</h4>
                                            <div class="alert-body">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                            </div>
                                        </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                
                
        </div>
</div>
@endif





