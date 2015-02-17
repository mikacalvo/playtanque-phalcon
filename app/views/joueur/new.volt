
{{ form("joueur/create", "method":"post") }}

<table width="100%">
    <tr>
        <td align="left">{{ link_to("joueur", "Go Back") }}</td>
        <td align="right">{{ submit_button("Save") }}</td>
    </tr>
</table>

{{ content() }}

<div align="center">
    <h1>Create joueur</h1>
</div>

<table>
    <tr>
        <td align="right">
            <label for="label">Label</label>
        </td>
        <td align="left">
            {{ text_field("label", "size" : 30) }}
        </td>
    </tr>
    <tr>
        <td align="right">
            <label for="poste">Poste</label>
        </td>
        <td align="left">
            {{ text_field("poste", "type" : "numeric") }}
        </td>
    </tr>

    <tr>
        <td></td>
        <td>{{ submit_button("Save") }}</td>
    </tr>
</table>

</form>
