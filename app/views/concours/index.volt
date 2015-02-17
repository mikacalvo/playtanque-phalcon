
{{ content() }}

<div align="right">
    {{ link_to("concours/new", "Create concours") }}
</div>

{{ form("concours/search", "method":"post", "autocomplete" : "off") }}

<div align="center">
    <h1>Search concours</h1>
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
            <label for="date">Date</label>
        </td>
        <td align="left">
                {{ text_field("date", "type" : "date") }}
        </td>
    </tr>
    <tr>
        <td align="right">
            <label for="options">Options</label>
        </td>
        <td align="left">
                {{ text_field("options", "type" : "date") }}
        </td>
    </tr>

    <tr>
        <td></td>
        <td>{{ submit_button("Search") }}</td>
    </tr>
</table>

</form>
