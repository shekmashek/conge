<div id="liste_detail" class="mt-2">
  <ul class="m-0">
    <li>Employé : {{ $congeRef->employe->nom_emp . ' ' . $congeRef->employe->prenom_emp }}</li>
    <li>Type : {{ $congeRef->type_conge->type_conge}}</li>
  </ul>
</div>
<form>
  <div class="modal-body">
    @csrf
    <input type="hidden" name="conge_id" id="id_conge" readonly>
    <div class="form-group">
      <label for="message">Motif</label>
      <textarea class="form-control" name="message" id="message_refus" rows="3"></textarea>
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button>
    <button type="button" id="btnConfirmRefus" onclick="confirmReject({{ $congeRef->id }})" class="btn btn-success">confirmer</button>
  </div>
</form>