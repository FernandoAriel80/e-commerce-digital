  @props([
  'objects'
  ])
  @if ($objects->count() > 0)
  @if ($objects->hasPages())
  <div class="pagination-container">
      <div class="pagination-links">
          @if ($objects->onFirstPage())
          <span class="pagination-btn disabled">← Anterior</span>
          @else
          <a href="{{ $objects->previousPageUrl() }}" class="pagination-btn">← Anterior</a>
          @endif
          <div class="pagination-numbers">
              @foreach ($objects->getUrlRange(1, $objects->lastPage()) as $page => $url)
              @if ($page == $objects->currentPage())
              <span class="pagination-btn active">{{ $page }}</span>
              @else
              <a href="{{ $url }}" class="pagination-btn">{{ $page }}</a>
              @endif
              @endforeach
          </div>
          @if ($objects->hasMorePages())
          <a href="{{ $objects->nextPageUrl() }}" class="pagination-btn">Siguiente →</a>
          @else
          <span class="pagination-btn disabled">Siguiente →</span>
          @endif
      </div>
      <div class="pagination-info">
          Página <strong>{{ $objects->currentPage() }}</strong> de <strong>{{ $objects->lastPage() }}</strong>
          | Total: <strong>{{ $objects->total() }}</strong> registros
      </div>
  </div>
  @endif
  @else
  <div class="pagination-no-results">
      <p>No se encontraron resultados.</p>
  </div>
  @endif