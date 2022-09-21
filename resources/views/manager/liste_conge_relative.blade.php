<div class="modal-header">
  <h5 class="modal-title" id="accepter_congeLabel">Liste des employés </h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
  <div class="modal-body-content">
    @if (count($congeRel))
    <table id="liste_en_attente" class="table table-striped" style="width:100%">
      <thead>
        <tr>
          <th>Employe</th>
          <th>Type</th>
          <th>Début</th>
          <th>Fin</th>
          <th>Motif</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($congeRel as $conge)
        <span>{{ $conge->id }}</span>
        <tr>
          <th scope="row">{{ $conge->employe->nom_emp . ' ' . $conge->employe->prenom_emp }}</th>
          <td>{{ $conge->type_conge->type_conge }}</td>
          <td>{{ $conge->debut }}</td>
          <td>{{ $conge->fin }}</td>
          <td>{{ $conge->motif }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
    @else
      <div>
        <p class="display-6 text-muted text-center"><em>Aucun congé</em></p>
      </div>
    @endif
  </div>
</div>
<div class="modal-footer">
  <button onclick="accepter_conge({{ $congeRef->id }})"data-bs-dismiss="modal" class="btn btn-success">Confirmer</button>
</div>
