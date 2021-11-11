// @ts-nocheck
/* global Fuse */
/**
 * @version 1.3.3
 * @description Update with Queena's review and Village Media Specs
 */

/* ============ Definitions ============ */

/* Constants */
var FUSE_SEARCH_FIELDS = [  // TODO  Need to find text in Additional Notes
    "ID",
    "UnitName",
    "Details.Dimensions.Dimensions",
    "Details['Additional Notes']['Submission Lead-Time']"
]

/* Menu ------------------------------------ */
var Menu = {};
Menu.init = function (list, searchParams) {
    function showMenuLabel(Filter2) {
        Filter2 = Filter2.replace(/_/g, " ");
        Menu.filterLabel.innerHTML = Filter2;
    }

    // function for checking scroll movement
    function checkScroll() {
        var doc = document.documentElement;
        var top = (window.pageYOffset || doc.scrollTop) - (doc.clientTop || 0);

        var filter2Query = searchParams.get('filter2');

        if (top >= 100) {
            //Menu.bar.classList.add('menu-red');
            Menu.topButton.classList.add('js-scroll');
            if (filter2Query) {
                showMenuLabel(filter2Query);
            }
        } else {
            //Menu.bar.classList.remove('menu-red');
            Menu.topButton.classList.remove('js-scroll');
            Menu.filterLabel.innerHTML = '';
        }

        if (top >= Menu.filter3NavTop) {
            Menu.filter3Nav.classList.add('js-Sticky');
        } else {
            Menu.filter3Nav.classList.remove('js-Sticky');
        }
    }

    Menu.bar = document.querySelector('.c-Menu_Bar');
    Menu.topButton = document.getElementById('c-Menu_ToTop');
    Menu.header = document.getElementById('c-Header_Top');
    Menu.filterLabel = document.getElementById('c-Menu_Filter2Label');
    Menu.filter3Nav = document.querySelector('.c-Filter3'); // part of section.c-Filter.g-Container
    Menu.filter3NavTop = Menu.filter3Nav.getBoundingClientRect().top + window.scrollY;

    // checkScroll();
    window.addEventListener('scroll', function () {
        checkScroll();
    });
    Menu.filterLabel.addEventListener('click', function () {
        Filter.lev1Wrap.scrollIntoView({ behavior: "smooth", block: "start", inline: "start" });
    });

    // Move to top button
    Menu.topButton.addEventListener('click', function () {
        Menu.header.scrollIntoView({ behavior: "smooth", block: "start", inline: "start" });
    });
} // Menu.init

/* searchbar ------------------------------------ */

var Searchbar = {};
Searchbar.init = function (list, searchParams) {
    Searchbar.bar = document.querySelector('.c-SearchBar_Wrap .g-Title');
    Searchbar.wrapper = document.querySelector('.c-SearchBar_Wrap');
    Searchbar.returnButton = document.querySelector('.c-SearchBar_Return');
    Searchbar.inputField = document.querySelector('.c-SearchBar_Input');
    Searchbar.filter = document.querySelector('#Filter');

    Searchbar.bar.addEventListener('click', function () {
        Searchbar.wrapper.classList.add('search-active');
        Searchbar.filter.classList.add('js-Hide');
        Filter.clearfilter(Filter.specsheetGroup);
        Searchbar.inputField.focus();
    });

    Searchbar.returnButton.addEventListener('click', function () {
        Searchbar.wrapper.classList.remove('search-active');
        Searchbar.filter.classList.remove('js-Hide');
    });

    // Search as user types
    Searchbar.inputField.addEventListener('keyup', function (e) {
        var input = e.target.value;
        searchAll(input);
    })

    // The search bar function
    function searchAll(searchTerm) {
        var options = {
            threshold: 0.3,
            location: 0,
            distance: 100,
            maxPatternLength: 32,
            minMatchCharLength: 3,
            findAllMatches: true,
            keys: FUSE_SEARCH_FIELDS
        };
        // create search
        var fuse = new Fuse(list, options);
        var searchResults = fuse.search(searchTerm);

        var resultsEl = document.querySelector('.c-Results');
        var resultsLi = '';
        // displaying the search results as a list
        searchResults.forEach(function (result) {
            var filter1Str = result['Type'].replace(/\s/gi, "_").replace(/&/gi, "_");
            var filter2Str = result['Subtype'].replace(/\s/gi, "_");
            var IDString = Util.sanitizeIdString(result['ID']);

            resultsLi += '<li><a class="c-Results_Item" href="?filter1=' + filter1Str + '&filter2=' + filter2Str + '#Specsheet-' + IDString + '">' + result['UnitName'] + '</a></li>';
        })
        resultsEl.innerHTML = resultsLi;
    }

} // Searchbar.init

/* filter ------------------------------------ */

var Filter = {};
/**
 * @description Build node elements from json spec list
 * @param {Array} specList
 */
Filter.init = function (specList, searchParams) {
    Filter.filterParameterSanitation = function (text) {
        return text.replace(/\s/gi, "_").replace(/&/gi, "_");
    }

    Filter.getSanitizedParameter = function (paramName) {
        var filterQuery = searchParams.get(paramName);

        if (filterQuery) {
            return Filter.filterParameterSanitation(filterQuery);
        }
    }

    // helper function to clear all the filters
    Filter.clearfilter = function (filterGroup) {
        if ("undefined" !== typeof filterGroup) {
            filterGroup.forEach(function (node) {
                if (node.classList.contains('js-ShowFilter')) {
                    node.classList.remove('js-ShowFilter');
                }
            })
        } else {
            console.warn("filterGroup:", filterGroup);
        }
    }

    // helper function to clear the focused selected filters
    Filter.clearFocus = function (filters) {
        if ("undefined" !== typeof filters) {
            filters.forEach(function (node) {
                if (node.classList.contains('js-Highlight')) {
                    node.classList.remove('js-Highlight')
                }
            })
        } else {
            console.warn("filters:", filters);
        }
    }

    // Show Filter 2 function
    function showFilter2() {
        // getting the filter1 param in the url, if there is, show		
        var filter1Query = searchParams.get('filter1');
        // var filter1Query = Filter.getSanitizedParameter('filter1'); // NOTE: May produce a type name not found in data

        if (filter1Query) {
            console.log(filter1Query);

            // highligth selected type
            var selector = 'filter-' + filter1Query;
            var selectedFilter1Input = document.getElementById(selector);

            if (selectedFilter1Input) {
                // will enable css rule
                selectedFilter1Input.checked = true;
                console.log(selectedFilter1Input);

                var selector2 = 'Filter1-' + filter1Query;
                var selectedFilter2Group = document.getElementById(selector2);

                if (selectedFilter2Group) {
                    Filter.clearfilter(Filter.lev2Group);
                    selectedFilter2Group.classList.add('js-ShowFilter');
                } /* else {
                    console.trace(selector2 + " not found");
                } */

            } /* else {
                console.trace(selector + " not found. Verify the type identifier.");
            } */
        }
    }

    // Show Filter 3 function
    function showFilter3() {
        // getting the filter 2 param in the url, if there is, show filter 3 group, and highlight the chosen filter
        var filter1Query = searchParams.get('filter1')
        var filter2Query = searchParams.get('filter2')
        var selector = '.c-Filter2_Item[data-filter2="' + filter2Query + '"]';
        var selectedEl = document.querySelector(selector);

        if (filter1Query && filter2Query) {
            console.log(filter2Query);

            if (selectedEl) {
                Filter.clearFocus(Filter.lev2);
                selectedEl.classList.add('js-Highlight');
            } else {
                console.warn(selector + " not found. Verify the subtype identifier.");
            }

            var selector2 = 'Filter1-' + filter1Query + '-Filter2-' + filter2Query;
            var selectedFilter3Group = document.getElementById(selector2);

            if (selectedFilter3Group) {
                Filter.clearfilter(Filter.lev3Group);
                selectedFilter3Group.classList.add('js-ShowFilter');
            } else {
                console.warn(selector2 + " not found. Verify the subtype identifier.");
            }
        }
    }

    // Show Specsheet function
    function showSpecsheet(filter2, spec) {
        var filter2Query, specVal, shortenedSpecVal, selectedEl;
        
        // if no parameters passed, get information form the URL
        if ("undefined" === typeof filter2) {
            // getting the filter 2 param in the url
            filter2Query = searchParams.get('filter2');

            // getting the chosen specsheet ID from the url, , get value after "#"
            specVal = window.location.hash.substr(1);

            // getting the chosen specsheet name from the url, get value after "#Specsheet-"
            shortenedSpecVal = window.location.hash.substr(11);
        } else {
            filter2Query = filter2;

            // getting the chosen specsheet ID
            specVal = spec;

            // getting the chosen specsheet name, get value after "Specsheet-"
            shortenedSpecVal = spec.substr(10);
        }

        // if chosen specsheet exists, highlight the selection, clear styles on other prev chosen
        if (specVal) {
            selectedEl = document.querySelector('.c-Filter3_Item[data-specsheet="' + shortenedSpecVal + '"]');
            Filter.clearFocus(Filter.lev3);
            // console.log(shortenedSpecVal);
            selectedEl.classList.add('js-Highlight');
        }

        if (filter2Query) {
            // filter all the specs related to filter 2
            searchFilter(filter2Query);

            setTimeout(function () {
                // Scroll to the selected specsheet in view
                if (specVal)
                    document.getElementById(specVal).scrollIntoView({ behavior: "smooth", block: "start", inline: "start" });
            }, 1000
            );
        }
    }

    // search function to fire when filter 3 item is clicked, taking the filter 2 val is argument
    function searchFilter(Filter2) {
        console.log(Filter2);
        var options = {
            maxPatternLength: 32,
            minMatchCharLength: 8,
            threshold: 0.0,
            findAllMatches: true,
            keys: ["Subtype"]
        };

        // create search with fuse.js, passing in the index we previous made
        console.log('list', SPECLIST); // SpecList is the list generated list of all specs
        var fuse = new Fuse(SPECLIST, options);
        var results = fuse.search(Filter2);
        console.log(results);

        // Displaying the results
        results.forEach(function (spec) {
            var specStr = spec["ID"];
            var selectedSheets = document.getElementById("SpecsheetWrap-" + specStr);
            selectedSheets.classList.add("js-ShowFilter");
        });
    }

    Filter.generatedNode = function (types) {
        console.log("data:", types);

        var node = document.createElement("div");
        node.className = "g-Container";

        // filter 1 - create and populate children
        var filter1Node = document.createElement("div");
        filter1Node.className = "c-Filter1 new";
        node1Html = "";

        // Filter 2 and 3 - create then loop to populate children
        var filter2Node = document.createElement("div");
        filter2Node.className = "c-Filter2 new";

        var filter3Node = document.createElement("div");
        filter3Node.className = "c-Filter3 new";


        // loop on data.types, subtypes then spec items
        for (var typeName in types) {
            // insert filter 1 type node
            var ui = types[typeName].ui;
            var subtypes = types[typeName].subtypes;

            node1Html += Filter.level_1_html(typeName, ui);

            var filter2Group = document.createElement("div");
            filter2Group.className = "c-Filter2_Group";
            filter2Group.id = `Filter1-${typeName}`;

            var filter2GroupHTML = "";

            for (var subtypeName in subtypes) {
                var subtypeItem = subtypes[subtypeName];

                filter2GroupHTML += Filter.level_2_html(typeName, subtypeName, subtypeItem.name);

                filter3Node.appendChild(
                    Filter.level_3_node(typeName, subtypeName, subtypeItem.spec)
                )

                console.log(`Filter 1: ${typeName} > Filter 2: ${subtypeName} > Filter 3: ${subtypeItem.name}`);
            }

            filter2Group.innerHTML = filter2GroupHTML;
            filter2Node.appendChild(filter2Group);
        }

        filter1Node.innerHTML = node1Html;
        node.appendChild(filter1Node);
        node.appendChild(filter2Node);
        node.appendChild(filter3Node);

        return node;
    }

    Filter.level_1_html = function (id, item) {
        return `
        <input class="c-Filter_Radio" id="filter-${id}" type="radio" name="filter" data-filter1="${id}"/>
        <label class="c-Filter1_Item" for="filter-${id}" style="${item.style}">
            <div class="c-Filter1_Overlay"></div>
            <div class="c-Filter1_ItemWrap">
                <div class="c-Filter1_Icon">
                    <img src="${item.icon}" alt="${item.alt}"/>
                </div>
                <h2 class="c-Filter1_Title">${item.name}</h2>
            </div>
        </label>
        `;
    }

    Filter.level_2_html = function (typeName, subtypeName, itemName) {
        var html = "";

        html += `
<div class="c-Filter2_Item" data-filter1="${typeName}" data-filter2="${subtypeName}">
    <p>${itemName}</p>
</div>
`;

        return html;
    }

    Filter.level_3_node = function (typeName, subtypeName, specs) {
        var node = document.createElement("div");
        node.className = "c-Filter3_Group";
        node.id = `Filter1-${typeName}-Filter2-${subtypeName}`;

        //debugger;

        // for each type
        html = "";

        specs.forEach(item => {
            console.log("item: ", item);

            html += `
<div class="c-Filter3_Item" data-filter1="${typeName}" data-filter2="${subtypeName}" data-specsheet="${item.ID}">
    <p>${item.UnitName}</p>
</div>
`;
        });

        node.innerHTML = html;

        return node;
    }

    /* execution */

    Filter.wrapper = document.querySelector('section#Filter');
    Filter.wrapper.appendChild(
        Filter.generatedNode(specList)
    );

    Filter.lev1 = document.querySelectorAll('.c-Filter1_Item');
    Filter.lev2 = document.querySelectorAll('.c-Filter2_Item');
    Filter.lev3 = document.querySelectorAll('.c-Filter3_Item');
    Filter.lev1Wrap = document.querySelector('.c-Filter1');
    Filter.lev2Wrap = document.querySelector('.c-Filter2');
    Filter.lev3Wrap = document.querySelector('.c-Filter3');
    Filter.lev2Group = document.querySelectorAll('.c-Filter2_Group');
    Filter.lev3Group = document.querySelectorAll('.c-Filter3_Group');
    Filter.specsheetGroup = document.querySelectorAll('.c-Specsheet_Wrap');

    // Show relevant filters on page load, if there are any to show, based on URL params
    showFilter2();
    showFilter3();
    showSpecsheet();

    // Listening on click
    document.addEventListener('click', function (e) {
        // Get the clicked element
        var clickEl = e.target;
        var clickedItem = e.target.className;

        // Setting up variables for selected filters according to event click
        var selectedFilter1;
        var selectedFilter2;
        var selectedSpec;

        switch (clickedItem) {
            // if first filter is clicked
            case 'c-Filter_Radio':
                console.log('first filter click');
                // set the filter value variable from data-filter on the element
                selectedFilter1 = clickEl.dataset.filter1;

                // reset all sub filters
                selectedFilter2 = '';
                selectedSpec = '';

                // clear if need be the filters shown
                Filter.clearfilter(Filter.lev2Group);
                Filter.clearfilter(Filter.lev3Group);
                Filter.clearfilter(Filter.specsheetGroup);
                Filter.clearFocus(Filter.lev2);

                // set search params in the url, and push state url
                searchParams.set('filter1', selectedFilter1);
                if (searchParams.has('filter2')) {
                    searchParams.delete('filter2');
                }
                window.history.pushState({}, '', '?' + searchParams.toString());

                // show filter 2
                showFilter2();

                // scroll to filter 2 position
                Filter.lev2Wrap.scrollIntoView({ behavior: "smooth", block: "start", inline: "start" });

                break;

            // if second filter is clicked
            case 'c-Filter2_Item':
                console.log('second filter click');

                // set the filter value variable from data-filter on the element
                selectedFilter2 = clickEl.dataset.filter2;

                // reset sub filters
                selectedSpec = '';

                // set filter 2 search params in the url, and push state
                searchParams.set('filter2', selectedFilter2);
                window.history.pushState({}, '', '?' + searchParams.toString());

                // clears all specsheets and filter focus if any prev has been chosen
                Filter.clearfilter(Filter.specsheetGroup);
                Filter.clearFocus(Filter.lev3);

                // show filters 3
                showFilter3();

                // scroll into view of filter 3
                Filter.lev3Wrap.scrollIntoView({ behavior: "smooth", block: "start", inline: "start" });

                break;

            // if selected specsheet is clicked
            case 'c-Filter3_Item':
                console.log('third filter click');

                // set filter variables from data-filters from the element
                selectedFilter2 = clickEl.dataset.filter2;
                selectedSpec = "Specsheet-" + clickEl.dataset.specsheet;
                console.log(selectedSpec);

                // set hash id value of the chosen specsheet to the url 
                window.history.pushState({}, '', '#' + selectedSpec);

                // clear all other spechseets and filters if prev chosen
                Filter.clearfilter(Filter.specsheetGroup);
                Filter.clearFocus(Filter.lev3);

                // Show the specsheet group using the searchFilter() function
                showSpecsheet(selectedFilter2, selectedSpec);
                console.log(selectedFilter2);

                break;

            // Toggle box info
            case 'c-Specsheet_BoxHeader':
            case 'c-Specsheet_BoxHeader js-Open':
                if (clickEl.classList.contains('js-Open')) {
                    clickEl.classList.remove('js-Open');
                } else {
                    clickEl.classList.add('js-Open');
                }

                break;

            case 'c-Results_Item':
                window.location.reload(true);

                break;

            default:
                break;
        }
    });
} // Filter.init

/* specsheets ------------------------------------ */

var Specsheets = {};
/**
 * @description Build node elements from json spec list
 * @param {Array} specList
 */
Specsheets.init = function (specs) {
    Specsheets.container = document.querySelector(".c-Specsheet .g-Container");
    Specsheets.getSheets = function () {
        return document.querySelectorAll(".c-Specsheet_Wrap");
    }


    /* execution */
    //console.table("speclist:", specList);

    Specsheets.removeSheetWraps();
    specs.forEach(item => Specsheets.append(item));
}
/**
 * @description Add a .c-Specsheet_Wrap element
 * @param {dictionnary} specInfo
 */
Specsheets.append = function (specInfo) {
    // Add a .c-Specsheet_Wrap element

    // console.table("specInfo:", specInfo);

    var idName = Util.sanitizeIdString(specInfo["ID"]);

    var container = document.createElement("div");
    container.className = "c-Specsheet_Wrap new";
    container.id = "SpecsheetWrap-" + idName;

    container.appendChild(
        Specsheets.specTitleNode(idName)
    );

    container.appendChild(
        Specsheets.mediaColumnNode(specInfo["Image"])
    );

    container.appendChild(
        Specsheets.infoColumnNode(specInfo)
    );

    //console.log(container);

    Specsheets.container.appendChild(container);
}
Specsheets.specTitleNode = function (idName) {
    //span.c-Specsheet_title
    //<span class="c-Specsheet_Anchor" id="Specsheet-:10_drop_ins"></span>

    var node = document.createElement("span")
    node.className = "c-Specsheet_Anchor";
    node.id = "Specsheet-" + idName;

    return node;
}
Specsheets.mediaColumnNode = function (imageName) {
    //div.c-Specsheet_MediaColumn
    //<div class="c-Specsheet_MediaColumn"> ...
    var node = document.createElement("div")
    node.className = "c-Specsheet_MediaColumn";

    node.appendChild(
        Specsheets.mediaImgNode(imageName)
    );

    return node;
}
Specsheets.mediaImgNode = function (name) {
    //<img 
    //class="c-Specsheet_MediaImage" 
    //src="./assets/img/specsheets/Audio.png" 
    //alt="Audio" 
    //onerror="this.src = './assets/img/specsheets/Placeholder-generic.png'"
    ///>

    var placeholder = "Placeholder-generic.png";
    var imgname = (!!name) ? name : placeholder;

    var img = document.createElement("img");
    img.className = "c-Specsheet_MediaImage";
    img.src = Folders.specs.img + imgname;
    img.alt = imgname;
    img.onerror = function () {
        this.src = Folders.specs.img + placeholder;
    };

    return img;
}
Specsheets.detailTitleNode = function (text) {
    //console.table("box data:", text);

    var node = document.createElement("h3");
    node.className = "c-Specsheet_Title";
    node.innerText = text;

    return node;
}
Specsheets.infoColumnNode = function (specInfo) {
    //div.c-Specsheet_InfoColumn
    //<div class="c-Specsheet_InfoColumn"> ...
    var node = document.createElement("div")
    node.className = "c-Specsheet_InfoColumn";

    // <h3 class="c-Specsheet_Title">:10 drop ins</h3>
    node.appendChild(
        Specsheets.detailTitleNode(specInfo["UnitName"])
    );

    // loop on Details childs
    // write a  <div class="c-Specsheet_Box">
    for (var item in specInfo.Details) {
        node.appendChild(
            Specsheets.detailBoxNode(item, specInfo.Details[item])
        );
    }

    return node;
}
Specsheets.mediaColumnNode = function (imageName) {
    //div.c-Specsheet_MediaColumn
    //<div class="c-Specsheet_MediaColumn"> ...
    var node = document.createElement("div")
    node.className = "c-Specsheet_MediaColumn";

    node.appendChild(
        Specsheets.mediaImgNode(imageName)
    );

    return node;
}
Specsheets.detailBoxNode = function (name, data) {
    //console.table("box data:", data);

    var node = document.createElement("div");
    node.className = "c-Specsheet_Box";

    node.appendChild(
        Specsheets.detailBoxHeaderNode(name)
    );
    node.appendChild(
        Specsheets.detailBoxContentNode(data)
    );

    return node;
}
Specsheets.detailBoxHeaderNode = function (text) {
    //console.table("Box Header:", text);

    var node = document.createElement("div");
    node.className = "c-Specsheet_BoxHeader js-Open"; //not sure about js-Open

    /*
    <div class="Specsheet_Toggle_Inform"></div>
    <h4 class="c-Specsheet_Heading">Additional Notes</h4>
    */
    var subnode = document.createElement("div");
    subnode.className = "Specsheet_Toggle_Inform";
    node.appendChild(subnode);

    subnode = document.createElement("h4");
    subnode.className = "c-Specsheet_Heading";
    subnode.innerText = text;
    node.appendChild(subnode);

    return node;
}
Specsheets.detailBoxContentNode = function (data) {
    //console.table("Box Content:", data);

    var node = document.createElement("div");
    node.className = "c-Specsheet_BoxContent";

    // loop on Details child's items
    // write  
    //      <h4 class="c-Specsheet_SubHeading">Submission Lead Time</h4>
    //      <div class="c-Specsheet_Spec">
    // if current item has 2+ subitems, write a ul

    /* eg
    <div class="Specsheet_Toggle_Inform"></div>
    <h4 class="c-Specsheet_Heading">Additional Notes</h4>
    */

    for (var item in data) {
        node.appendChild(
            Specsheets.boxContentSubheading(item)
        );

        node.appendChild(
            Specsheets.boxContentSpec(data[item])
        );
    }

    return node;
}
Specsheets.boxContentHeading = function (text) {
    var node = document.createElement("h4");
    node.className = "c-Specsheet_Heading";
    node.innerHTML = text;

    return node;
}
Specsheets.boxContentSubheading = function (text) {
    var node = document.createElement("h4");
    node.className = "c-Specsheet_SubHeading";
    node.innerHTML = text;

    return node;
}
Specsheets.boxContentSpec = function (data) {
    var node = document.createElement("div");
    node.className = "c-Specsheet_Spec";

    if ("string" === typeof data) {
        node.appendChild(
            Specsheets.pNode(data)
        );
    } else {
        node.appendChild(
            Specsheets.ulNode(data)
        );
    }

    return node;
}
Specsheets.pNode = function (data) {
    //console.log("p data:", data);

    var node = document.createElement("p");
    node.innerHTML = data;

    return node;
}
Specsheets.ulNode = function (data) {
    //console.table("ul data:", data);

    var ul = document.createElement("ul");

    for (var item in data) {
        var li = document.createElement("li");
        li.innerHTML = data[item];

        ul.appendChild(li);
    }

    return ul;
}
Specsheets.removeSheetWraps = function () {
    [...document.getElementsByClassName("c-Specsheet_Wrap")].map(n => n && n.remove());
}

/* Message box ---------------------------------- */

MessageBox = document.querySelector("#MessageBox");
MessageWrapper = MessageBox.querySelector(".wrapper");
showMessage = (title, msg) => {
    MessageBox.querySelector("h1").innerText = title;
    MessageBox.querySelector("pre").innerHTML = "";
    MessageBox.querySelector("a").href = `mailto:#RMI_DigitalAdTech@rci.rogers.com?subject=Ad%20Spec%20Page&body=Ooops%20!!%20%20An%20error%20occured%20on%20the%20AD%20SPECIFICATIONS%20page!%0D%0A%0D%0APage%20URL%3A%0D%0A${encodeURIComponent(window.location.href)}%0D%0A%0D%0AError%20Message%3A%0D%0A${encodeURIComponent(msg)}%0D%0A%0D%0AThanks%20for%20sending%20this%20notification%20to%20Ad%20Tech%20Support%20team.%0D%0A%0D%0A`;
    MessageBox.classList.remove("js-hide");
    console.error(error);
}
showError = (title, error) => {
    MessageBox.querySelector("h1").innerText = title;
    MessageBox.querySelector("pre").innerHTML = error;
    MessageBox.querySelector("a").href = `mailto:#RMI_DigitalAdTech@rci.rogers.com?subject=Ad%20Spec%20Page&body=Ooops%20!!%20%20An%20error%20occured%20on%20the%20AD%20SPECIFICATIONS%20page!%0D%0A%0D%0APage%20URL%3A%0D%0A${encodeURIComponent(window.location.href)}%0D%0A%0D%0AError%20Message%3A%0D%0A${encodeURIComponent(error)}%0D%0A%0D%0AThanks%20for%20sending%20this%20notification%20to%20Ad%20Tech%20Support%20team.%0D%0A%0D%0A`;
    MessageBox.classList.remove("js-hide");
    console.error(error);
}

/* utilities ------------------------------------ */

var Util = {};
Util.sanitizeIdString = function (name) {
    return name.replace(/\s/gi, "_").replace(/\//g, '_').replace(/\./g, '_').replace(/:/g, '_');
}


var Folders = {};
Folders.specs = {};
Folders.specs.img = "./assets/img/specsheets/";

var SPECS = {};
var SPECLIST = [];

/* ============ Execution ============ */

// Checking dependencies
try {
    if ("undefined" === typeof Fuse) {
        throw new Error("Fuse librarie is missing");
    }

    if (
        "undefined" === typeof URLSearchParams || "undefined" === typeof Headers ||
        "undefined" === typeof Request || "undefined" === typeof Response
    ) {
        throw new Error("polyfill asset is missing");
    }

    // Getting specsheet.json Data
    console.log("Fetching specs");

    //var specsheetsData = fetch('./specsheets.json');
    fetch('./data/data.json')  // data.json or ERROR.json or DOESNOTEXIST.json
        .then(res => res.json())
        // Make an index for search

        .then(res => {
            console.log("processing specs");

            var getSpecList = function (types) {
                // Get ad types as a tree
                var list = [];

                for (typeName in types) {
                    var subtypes = types[typeName].subtypes;

                    for (subtypeName in subtypes) {
                        var specs = subtypes[subtypeName].spec

                        list = [...list, ...specs];
                    }

                };

                return list;
            }

            //debugger;

            SPECS = res.types;
            SPECLIST = getSpecList(SPECS);
        })
        .then(function () {
            try {
                console.log('Building');

                MessageBox.classList.add("js-hide");  // if javascript works, the error message is hidden

                // Grabbing the query string object
                var searchParams = new URLSearchParams(window.location.search);

                // Specs Content Generation ----------------------------
                Specsheets.init(SPECLIST);

                // Filters Generation ---------------------------------
                console.log('filter init');
                Filter.init(SPECS, searchParams);

                // SearchBar -------------------------------
                //debugger
                console.log('searbar init');
                Searchbar.init(SPECLIST, searchParams);

                // Menu ------------------------------------
                console.log('Menu init');
                Menu.init(SPECS, searchParams);

            } catch (error) {
                showError("Processing is going bad", error);
            }
        })

        .catch(function (error) {
            showError("The app's going crazy, general error", error);

            // alert("Processing Error.\nSee console for more details.");
        });


} catch (error) {
    showError("Loading error", error);
}
