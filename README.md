# Static Sites

Adds generic static module that provides hooks to define a static site. Sites implementing this module provide some meta-data about their static site and static scans the module's files and builds out the menu and rendering engines. Sites can provide markdown files and static will use a markdown library to convert the content to html before rendering. Content remains in the filesystem, and as a result, can be source controlled.
