---
# NOTICE: Copyright 2026 Talend SA, Talend, Inc., and affiliates. All Rights Reserved. Customer’s use of the software contained herein is subject to the terms and conditions of the Agreement between Customer and Talend.
layout: "apiDefinition_1.1.0"
api-definition:
  specVersion: "4.1.0"
  info:
    name: "aaa"
    version: "1.0.0"
    description: "No description"
    license: {}
    contact: {}
    termsOfService: ""
  contract:
    mediaTypes:
    - "application/json"
  components: {}
api-tryin: |-
  {
    "version" : 6,
    "entities" : [ {
      "entity" : {
        "type" : "Project",
        "name" : "aaa 1.0.0",
        "description" : "No description",
        "importedFrom" : "0ae46e77-5a42-41e9-85f8-3ce90eb38780"
      }
    } ],
    "environments" : [ {
      "name" : "aaa 1.0.0",
      "importedFrom" : {
        "projectId" : "0ae46e77-5a42-41e9-85f8-3ce90eb38780"
      },
      "variables" : {
        "e0c12fe3-53b8-4021-8ebd-94495fffc8cf" : {
          "name" : "BaseUrl",
          "value" : "https://example.com",
          "enabled" : true,
          "private" : false
        }
      }
    } ]
  }
---
