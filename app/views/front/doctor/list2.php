<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js"></script>



</head>

<body>
<div class="col-xs-12 col-sm-12 col-md-10">

    <div ng-controller="NewsController">
        Сортировать:
        <div>
            <h2>{{helloTo.title}}!</h2>
        </div>
        <ul>
            <li><a href="#" ng-click="setOrder('rating', false)">по дате</a></li>
            <li><a href="#" ng-click="setOrder('price', true)">по полезности</a></li>
        </ul>
        <table ng-init="getNews()">
            <tr ng-repeat="newsItem in news | orderBy: orderOptions.field:reverseOptions[orderOptions.field]" ng-cloak>
                <td></td>


            </tr>
        </table>
    </div>
    </div>


</body>
<script src="js/controllers/NewsController.js"></script>
</html>