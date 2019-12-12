<nav id="sidebar">
    <div class="sidebar-header">
        <h3>Test Sınavı Otomasyonu</h3>
    </div>

    <ul class="list-unstyled sidebar-list">  
        @if (Auth::user()->role->name != "Admin")
            <li class="{{ Request::is('dashboard*') ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}">
                    <i class="fas fa-tachometer-alt"></i> Kontrol Paneli
                </a>
            </li> 
        @endif
        @if(Auth::user()->role->name == "Admin")                          
            <li class="{{ Request::is('faculty*') ? 'active' : '' }}">
                <a href="{{ route('faculty.index') }}">
                    <i class="fas fa-university"></i> Fakülte İşlemleri
                </a>
            </li>                
            <li class="{{ Request::is('class*') ? 'active' : '' }}">
                <a href="{{ route('class.index') }}">
                    <i class="fas fa-chalkboard-teacher"></i> Sınıf İşlemleri 
                </a>
            </li>
            <li class="{{ Request::is('department*') ? 'active' : '' }}">
                <a href="{{ route('department.index') }}">
                    <i class="fas fa-building"></i> Bölüm İşlemleri
                </a>
            </li>
            <li class="{{ Request::is('user*') ? 'active' : '' }}">
                <a href="{{ route('user.index')}}">
                    <i class="fas fa-users"></i> Kullanıcı İşlemleri
                </a>
            </li>
            <li class="{{ Request::is('course*') ? 'active' : '' }}">
                <a href="{{ route('course.index') }}">
                    <i class="fas fa-book"></i> Ders İşlemleri
                </a>
            </li>
            <li class="{{ Request::is('assignment*') ? 'active' : '' }}">
                <a href="{{ route('assignment.index') }}">
                    <i class="fas fa-user-check"></i> Ders Atama İşlemleri  
                </a>
            </li>
            <li>
                <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <i class="fas fa-calendar-alt"></i> Yıl-Dönem İşlemleri
                </a>
                <ul class="collapse list-unstyled" id="pageSubmenu">
                    <li>
                        <a href="{{ route('term.index') }}">Dönem İşlemi</a>
                    </li>
                    <li>
                        <a href="{{ route('year.index') }}">Yıl İşlemi</a>
                    </li>
                    <li>
                        <a href="{{ route('year-term.index') }}">Yıl Dönem İşlemi</a>
                    </li>
                </ul>
            </li>
        @endif
        <li class="{{ Request::is('list-exam') ? 'active' : '' }}">
            <a href="{{ route('exam.list') }}">
                <i class="fas fa-tasks"></i> Sınavlar
            </a>
        </li>
        <li class="{{ Request::is('exam*') ? 'active' : '' }}">
            <a href="{{ route('exam.index') }}">
                <i class="fas fa-file-alt"></i> Test Sınavı Okut
            </a>
        </li>
    </ul>
</nav>