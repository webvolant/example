/**
 * Created by barkalovlab on 03.03.15.
 */


    angular.module("blfilter")

    .controller("HelloController", function($scope) {
        $scope.helloTo = {};
        $scope.helloTo.title = "Filter of Blocks";

    })

    .controller("FilterController", function($scope,$rootScope) {
        $scope.items = [
            {name: 'Code', id:'Code'},
            {name: 'Design', id:'Design'},
            {name: 'HTML', id:'HTML'}
            ];

        $scope.vars = {};
        $scope.formInfo = {};

        $scope.vars.items =
                [
                    {article :
                        [
                            {url:"../images/1.png"},
                            {tags:[{tag:"ALL"}, {tag:"Code"}, {tag:"HTML"}]}
                        ]
                    },
                    {article :
                        [
                            {url:"../images/2.png"},
                            {tags:[{tag:"ALL"}, {tag:"Design"}, {tag:"HTML"}]}
                        ]
                    },
                    {article :
                        [
                            {url:"../images/3.png"},
                            {tags : [{tag:"ALL"}, {tag:"Code"}]}
                        ]
                    },
                    {article :
                        [
                            {url:"../images/4.png"},
                            {tags:[{tag:"ALL"}, {tag:"Code"}]}
                        ]
                    },
                    {article :
                        [
                            {url:"../images/5.png"},
                            {tags:[{tag:"ALL"}, {tag:"Code"}, {tag:"Design"}, {tag:"HTML"}]}
                        ]
                    },
                    {article :
                        [
                            {url:"../images/6.png"},
                            {tags : [{tag:"ALL"}, {tag:"Code"}]}
                        ]
                    },
                    {article :
                        [
                            {url:"../images/7.png"},
                            {tags : [{tag:"ALL"}, {tag:"Code"}, {tag:"HTML"}]}
                        ]
                    }
                ];

            $rootScope.rootvars = {};
            $rootScope.rootvars.tag = "ALL";
            $rootScope.handleThisElement = function($event) {
                $rootScope.rootvars.tag = $event.target.id;

            };

    })


        .filter('check', function() {
            return function(articles, tag) {
                var filtered = [];
                (articles || []).forEach(function (article) {
                 var flag = 0;
                (article.article || []).forEach(function (item) {
                    (item.tags || []).forEach(function (i) {
                        if (i.tag == tag){
                            flag = 1;
                        }
                    });
                });
                    if (flag == 1){
                        filtered.push(article);
                    }
                });
                return filtered;
            };
        });

