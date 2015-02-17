
{{ content() }}

<table width="100%">
    <tr>
        <td align="left">
            {{ link_to("concours/index", "Go Back") }}
        </td>
        <td align="right">
            {{ link_to("concours/new", "Create ") }}
        </td>
    </tr>
</table>

<table class="browse" align="center">
    <thead>
        <tr>
            <th>Id</th>
            <th>Label</th>
            <th>Date</th>
            <th>Options</th>
         </tr>
    </thead>
    <tbody>
    {% if page.items is defined %}
    {% for concour in page.items %}
        <tr>
            <td>{{ concour.id }}</td>
            <td>{{ concour.label }}</td>
            <td>{{ concour.date }}</td>
            <td>{{ concour.options }}</td>
            <td>{{ link_to("concours/edit/"~concour.id, "Edit") }}</td>
            <td>{{ link_to("concours/delete/"~concour.id, "Delete") }}</td>
        </tr>
    {% endfor %}
    {% endif %}
    </tbody>
    <tbody>
        <tr>
            <td colspan="2" align="right">
                <table align="center">
                    <tr>
                        <td>{{ link_to("concours/search", "First") }}</td>
                        <td>{{ link_to("concours/search?page="~page.before, "Previous") }}</td>
                        <td>{{ link_to("concours/search?page="~page.next, "Next") }}</td>
                        <td>{{ link_to("concours/search?page="~page.last, "Last") }}</td>
                        <td>{{ page.current~"/"~page.total_pages }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </tbody>
</table>
