
{{ content() }}

<table width="100%">
    <tr>
        <td align="left">
            {{ link_to("joueur/index", "Go Back") }}
        </td>
        <td align="right">
            {{ link_to("joueur/new", "Create ") }}
        </td>
    </tr>
</table>

<table class="browse" align="center">
    <thead>
        <tr>
            <th>Id</th>
            <th>Label</th>
            <th>Poste</th>
         </tr>
    </thead>
    <tbody>
    {% if page.items is defined %}
    {% for joueur in page.items %}
        <tr>
            <td>{{ joueur.id }}</td>
            <td>{{ joueur.label }}</td>
            <td>{{ joueur.poste }}</td>
            <td>{{ link_to("joueur/edit/"~joueur.id, "Edit") }}</td>
            <td>{{ link_to("joueur/delete/"~joueur.id, "Delete") }}</td>
        </tr>
    {% endfor %}
    {% endif %}
    </tbody>
    <tbody>
        <tr>
            <td colspan="2" align="right">
                <table align="center">
                    <tr>
                        <td>{{ link_to("joueur/search", "First") }}</td>
                        <td>{{ link_to("joueur/search?page="~page.before, "Previous") }}</td>
                        <td>{{ link_to("joueur/search?page="~page.next, "Next") }}</td>
                        <td>{{ link_to("joueur/search?page="~page.last, "Last") }}</td>
                        <td>{{ page.current~"/"~page.total_pages }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </tbody>
</table>
