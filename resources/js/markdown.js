const easyMDE = new EasyMDE({
  element: document.getElementById('body'),
  spellChecker: false, // 日本語はスペルチェックに引っかかるので以下のプロパティでスペルチェックをオフする
   toolbar: [
        {              
            name: "heading-1",
            action: EasyMDE.toggleHeading1,
            className: "fa fa-header header-1",
            title: "見出し1",
        },
        {              
            name: "heading-2",
            action: EasyMDE.toggleHeading2,
            className: "fa fa-header header-2",
            title: "見出し2",
        },
        {              
            name: "heading-3",
            action: EasyMDE.toggleHeading3,
            className: "fa fa-header header-3",
            title: "見出し3",
        },
        "|",
        {              
            name: "bold",
            action: EasyMDE.toggleBold,
            className: "fa fa-bold",
            title: "太字",
        },
        {              
            name: "italic",
            action: EasyMDE.toggleItalic,
            className: "fa fa-italic",
            title: "斜体",
        },
        {              
            name: "strikethrough",
            action: EasyMDE.toggleStrikethrough,
            className: "fa fa-strikethrough",
            title: "打ち消し線",
        },
         { //jsを用いてオリジナルのツール作成
          name: "red-text",
          action: function(editor) {
            const cm = editor.codemirror;
            const selectedText = cm.getSelection();
            const color = prompt("色を指定してください（例: red, blue, #ff0000）", "red");
            if (color) {
              cm.replaceSelection(`<span style="color:${color};">${selectedText}</span>`);
            }
          },
          className: "fa fa-paint-brush",
          title: "文字色を変更"
        },
        "|",
        // {              
          //     name: "",
          //     action: EasyMDE.,
          //     className: "",
          //     title: "",
          // },
          // {              
            //     name: "",
            //     action: EasyMDE.,
            //     className: "",
            //     title: "",
            // },
            // {              
              //     name: "",
              //     action: EasyMDE.,
              //     className: "",
              //     title: "",
              // },
              {              
                  name: "side-by-side",
                  action: EasyMDE.toggleSideBySide,
                  className: "fa fa-columns no-disable no-mobile",
                  title: "エディタとプレビューを並べて表示",
              },
            ]
          });