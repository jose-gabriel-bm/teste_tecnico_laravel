<nav class="d-flex flex-column flex-shrink-0 p-3 bg-white" style="width: 280px; height: 100vh; border-right: 1px solid #ddd;">
  <a href="/signatarios/listagem" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-decoration-none">
    <span class="fs-4">Trilha de Assinatura</span>
  </a>
  <hr>
  <ul class="nav nav-pills flex-column mb-auto">
    <li class="nav-item">
      <a href="/signatarios/listagem" class="nav-link {{ request()->is('signatarios/listagem') ? 'active' : 'text-dark' }}" aria-current="page">
        <i class="bi bi-person-lines-fill me-2"></i> Signatários
      </a>
    </li>
    <li>
      <a href="/processos/listagem" class="nav-link {{ request()->is('processos/listagem') ? 'active' : 'text-dark' }}">
        <i class="bi bi-file-earmark-text-fill me-2"></i> Processos Digitais
      </a>
    </li>
    <li>
      <a href="/relatorios" class="nav-link {{ request()->is('relatorios') ? 'active' : 'text-dark' }}">
        <i class="bi bi-bar-chart-fill me-2"></i> Relatórios
      </a>
    </li>
    <li>
      <a href="/relatorios" class="nav-link {{ request()->is('relatorios') ? 'active' : 'text-dark' }}">
        <i class="bi bi-exclamation-diamond-fill me-2"></i> Logs
      </a>
    </li>
  </ul>
  <hr>
    <ul class="nav nav-pills">
      <li>
        <a href="#" class="nav-link text-dark" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
          <i class="bi bi-box-arrow-right me-2"></i> Sair
        </a>
      </li>
    </ul>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
      @csrf
    </form>
</nav>
