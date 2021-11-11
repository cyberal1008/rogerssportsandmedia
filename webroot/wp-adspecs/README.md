# Ad Spec Project

Copy from <https://rogers-adspecs.netlify.app/>

Hosted on <https://rogersadops-a.akamaihd.net/AdSpecs/index.html>

<br/>

## Mode

Data Driven Design.

ECMAScript 2015 (ES6) coding, supported by modern browsers. <https://caniuse.com/#feat=es6>

<br/><br/>

## Work Phases

1. Specsheets section "Data Driven" DOM generation ![Done](./docImages/ok-icon.png)
1. refactor data and app.js ![Done](./docImages/ok-icon.png)
    * to use alphanumeric IDs (no special char, no spaces)
        * Current specsheet item list is processed as Array, so item id (eg "10 drop ins":) is not used
        * Add fields: id  
    * to rename data.json >
        * specsheets["Unit Name"] to specsheets["UnitName"]
        * specsheets["Filter 1"] to specsheets["Type"]
        * specsheets["Filter 2"] to specsheets["subtype"]

1. Refactor to remove window level variable from function arguments ![Done](./docImages/ok-icon.png)

1. Filter section "Data Driven" DOM generation ![Done](./docImages/ok-icon.png)

1. Specsheets.json update validation

1. Revise Spec list generation to get type and subtype from parent nodes # TODO 

<br/><br/>


## Data Validation/Sanitation

* ID: alphanumeric, no blank nor special chars

<br/><br/>

## Notes

<br/>

### CSS

<br/>

### HTML

Dynamic Copyright year

<br/><br/>

## Data Formats

<br/>

### data.json - _Specs_

Stored as _Specs_ in app.js (see execution part)

    {
        "types": collection of Type
    }

Type:

    name: string - valid css selector, used as ID and data-filter1 node parameter :
        {
            style: string - js inline style
            icon: string  - relative url of the icon image
            alt: string   - img alt text
            name: string  - html representation of type name
            subtypes: string - collection of Subtype
        }

Subtype:

    subtype: string - valid css selector, used as ID and data-filter2 node parameter :  
        {
            name: string  - item name, text only
            specs: array - collection of Specsheet
        }

Specsheet:

    {
        ID: string  - valid css selector, used as node identifier
        UnitName: string - item name, text only
        Type: string - Alphanumeric noblank text, used for content filtering
        Subtype: string - Alphanumeric noblank text, used for content filtering
        Image: string - relative url of ad creative sample image
        Details: SpecDetail - page content to be generated, data must not be sorted, data depends on ad item specification
    }

SpecDetail:

    collection of string, sting[] and sub collection of such

    * data depends on ad item specification
    * "Additional Notes" id used to provide instructions to user, is optional but recommended

<br/>

### SpecList