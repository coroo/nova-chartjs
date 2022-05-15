# Changelog

All notable changes to `chart-js-integration` will be documented in this file

## v0.4.0 - 2022-05-15

- :sparkles: add new support for nova v4.x

## v0.3.4 - 2021-02-11

- :sparkles: add new feature: custom x-axis

## v0.3.3 - 2021-02-08

- :wrench: change api request to /nova-vendor/

## v0.3.2 - 2020-09-17

- :wrench: fix bug for line chart using model

## v0.3.1 - 2020-09-15

- :wrench: fix error for psql database connection
- Add `hour` as UOM
- ⬆️ Bump http-proxy from 1.18.0 to 1.18.1 dependencies

## v0.3.0 - 2020-08-11

- :angel: new baby born
- add plugin datalabels
- add roadmap for plugin

## v0.2.7 - 2020-08-10

- support Laravel DB connection table prefixes for models

## v0.2.6 - 2020-06-10

- update dependencies in security vulnerability: 
    - Bump websocket-extensions from 0.1.3 to 0.1.4
        - 8efd0cd Bump version to 0.1.4
        - 3dad4ad Remove ReDoS vulnerability in the Sec-WebSocket-Extensions header parser
        - 4a76c75 Add Node versions 13 and 14 on Travis
        - 44a677a Formatting change: {...} should have spaces inside the braces
        - f6c50ab Let npm reformat package.json
        - 2d211f3 Change markdown formatting of docs.
        - 0b62083 Update Travis target versions.
        - 729a465 Switch license to Apache 2.0.

## v0.2.5 - 2020-06-04

- update for some bugs:
    - #41 Problems getting charts to display
    - #45 Unable to set fill for linechart
    - #46 Areachart does not support RGBA color values

## v0.2.4 - 2020-04-14

- add new feature: tooltips
- :fire: remove unused fontawesome
- update documentation

## v0.2.3 - 2020-03-31

- add new chart: polar area chart
- add new feature: reload button
- update documentation

## v0.2.2 - 2020-03-27

- add default button filter metrics. available for:
    - doughnut
    - pie
    - bar
    - stacked
    - line
    - area
- update documentation for filter metrics button

## v0.2.1 - 2020-03-25

- new feature: button filter metrics. available for:
    - doughnut
    - pie
    - bar
    - stacked
    - line
    - area
- add documentation for filter metrics button
- update documentation

## v0.2.0 - 2020-03-18

- major update: add new feature for clickable chart with sweetalert2
    - doughnut
    - pie
    - bar
    - stacked
    - line
    - area
- add new feature: go to external link
- add documentation for external link button
- add documentation for clickable chart with sweetalert2
- update documentation

## v0.1.5 - 2020-03-11

- add workaround for change border color for circle chart
- update documentation

## v0.1.4 - 2020-02-21

- add new feature: join table
- change documentation url if any error notification
- add multiple condition in `case when` for laravel model
- update documentation

## v0.1.3 - 2020-02-25

- fixing bug related pie and doughnut chart with API error

## v0.1.2 - 2020-02-21

- add layout configuration
- update documentation

## v0.1.1 - 2020-02-20

- major update: change options behavior
- add legend configuration
    - set legend
    - hide legend
- update documentation

## v0.0.17 - 2020-02-06

- add scatter-chart feature
- update documentation

## v0.0.16 - 2020-01-13

- add refresh button feature
- update documentation

## v0.0.15 - 2020-01-11

- fix bug for not showing label when hover to stacked chart

## v0.0.14 - 2020-01-09

- add daily view feature
- move documentation to [github page](https://coroo.github.io/chart-js-integration/)

## v0.0.13 - 2020-01-06

- fix weekly base view bug in v0.0.12 release
- add start week option
- update documentation

## v0.0.12 - 2020-01-02

- add weekly base view
- update documentation

## v0.0.11 - 2019-12-30

- add doughnut chart feature
- add pie chart feature
- update documentation

## v0.0.10 - 2019-12-27

- fix issue for bar chart with data after v0.0.9 release
- remove unlisted console log

## v0.0.9 - 2019-12-26

- add line chart feature
- add area chart feature
- update documentation

## v0.0.8 - 2019-12-26

- fix issue style
    - https://github.com/coroo/chart-js-integration/issues/5

## v0.0.6 - 2019-12-19

- fix bug for v0.0.5 release
    - fix sum calculation for total not changed
- add number format in chart using M for million and K for thousand.

## v0.0.5 - 2019-12-19

- add sum calculation instead of count
- update documentation for chart-js-integration with new feature
- fix bug for v0.0.4 release
    - filter data error for IS NULL and IS NOT NULL

## v0.0.4 - 2019-12-18

- add filter data feature
- add latest month feature
- add custom chart color
- hide total feature
- update documentation for chart-js-integration with new feature

## v0.0.3 - 2019-12-18

- update documentation for chart-js-integration with model
- add custom column calculation

## v0.0.2 - 2019-12-18

- add chart js integration with model

## v0.0.1 - 2019-12-13

- initial release
- chart-js-integration with custom data
- bar chart feature
- stacked chart feature
