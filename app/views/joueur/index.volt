
{{ content() }}

<div align="right">
    {{ link_to("joueur/new", "Create joueur") }}
</div>

{{ form("joueur/search", "method":"post", "autocomplete" : "off") }}

<div align="center">
    <h1>Search joueur</h1>
</div>

<table>
    <tr>
        <td align="right">
            <label for="id">Id</label>
        </td>
        <td align="left">
            {{ text_field("id", "type" : "numeric") }}
        </td>
    </tr>
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
        <td>{{ submit_button("Search") }}</td>
    </tr>
</table>

</form>
