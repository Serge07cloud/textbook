
<div class="row form-group">
    <div class="col-sm">
        <label for="niveau">NIVEAU</label>
        <select name="niveau" id="niveau" class="form-control" onchange="afficherSpecialites(this.value)">
            <option value=""></option>
        </select>
    </div>
    <div class="col-sm">
        <label for="specialite">PARCOURS</label>
        <select name="specialite" id="specialite" class="form-control" onchange="afficherGroupe(this.value)">
            <option value=""></option>
        </select>
    </div>
</div>

<div class="">
    <table class="table">
        <tr>
            <td>TYPE ENSEIGNEMENT</td>
            <td>NOMBRE DE GROUPE(S) ATTRIBUE(S)</td>
        </tr>
        <tr id="cm">
            <td><input type="checkbox" class="form-check-input" id="cm_value" name="cm_value">Cours Magistral (CM)</td>
            <td><label for="cm_value" class="form-check-label"><span>0</span></label></td>
        </tr>
        <tr id="td">
            <td><input type="checkbox" class="form-check-input" id="td_value" name="td_value">Travaux Dirigés (TD)</td>
            <td><label for="td_value" class="form-check-label"><span>0</span></label></td>
        </tr>
        <tr id="tp">
            <td><input type="checkbox" class="form-check-input" id="tp_value" name="tp_value">Travaux Pratiques (TP)</td>
            <td><label for="tp_value" class="form-check-label"><span>0</span></label></td>
        </tr>
        <tr>
            <td><input type="checkbox" class="form-check-input" id="all">SELECTIONNER TOUT</td>
            <td><label for="tp_value" class="form-check-label"></label></td>
        </tr>
    </table>

    <div class="container text-right">
        <input type="submit" class="btn btn-primary" value="Resume" name="resume">
    </div>
</div>