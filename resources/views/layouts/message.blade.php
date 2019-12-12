@if(session()->get('success'))
    <div class="col-sm-12 pr-0 pl-0" id="alert-box">        
        <div class="alert alert-success">
            <div class="alert-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="alert-content">
                <p class="alert-type">BAŞARILI</p>
                <p class="alert-message">{{ session()->get('success') }}</p>
            </div>
        </div>        
    </div>
@endif 

@if(session()->get('warning'))
    <div class="col-md-12 pr-0 pl-0" id="alert-box">        
        <div class="alert alert-warning">
            <div class="alert-icon">
                <i class="fas fa-exclamation-circle"></i>
            </div>
            <div class="alert-content">
                <p class="alert-type">UYARI</p>
                <p class="alert-message">{{ session()->get('warning') }}</p>
            </div>
        </div>        
    </div>
@endif 