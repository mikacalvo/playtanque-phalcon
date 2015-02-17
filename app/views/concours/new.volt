
{{ form("concours/create", "method":"post") }}

<table width="100%">
    <tr>
        <td align="left">{{ link_to("concours", "Go Back") }}</td>
        <td align="right">{{ submit_button("Save") }}</td>
    </tr>
</table>

{{ content() }}

<div align="center">
    <h1>Create concours</h1>
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
        <td>{{ submit_button("Save") }}</td>
    </tr>
</table>

</form>
