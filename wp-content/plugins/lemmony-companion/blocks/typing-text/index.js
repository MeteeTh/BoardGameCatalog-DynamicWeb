(()=>{"use strict";const e=window.wp.element,t=window.wp.blocks,n=window.wp.i18n,l=window.wp.components,a=window.wp.blockEditor,i=JSON.parse('{"u2":"lemmony-companion/typing-text"}');(0,t.registerBlockType)(i.u2,{icon:(0,e.createElement)("svg",{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 32 32"},(0,e.createElement)("path",{d:"M10.239,30.5H3.5c-1.103,0-2-0.897-2-2v-6.739c0-0.001,0-0.002,0-0.003l0,0c0-0.001,0-0.002,0-0.003l0,0 c0.001-0.133,0.027-0.259,0.075-0.375c0.049-0.118,0.121-0.229,0.218-0.326L17.186,5.66c0.003-0.003,0.007-0.006,0.01-0.009 c0.003-0.003,0.006-0.006,0.01-0.009l2.245-2.246C20.673,2.173,22.299,1.5,24.027,1.5s3.354,0.673,4.576,1.896 C29.826,4.618,30.5,6.243,30.5,7.972c0,1.729-0.674,3.355-1.896,4.577l-2.236,2.237c-0.006,0.006-0.012,0.012-0.018,0.018 s-0.012,0.012-0.018,0.018L10.946,30.207c-0.001,0.002-0.002,0.003-0.002,0.003c0,0-0.001,0.001-0.002,0.002h0 c-0.001,0.001,0-0.002-0.002,0.003c0,0-0.001,0-0.001,0.001c-0.093,0.091-0.199,0.159-0.312,0.207 C10.507,30.473,10.376,30.5,10.239,30.5z M3.5,22.175V28.5h6.325l14.403-14.403l-6.326-6.325L3.5,22.175z M19.316,6.358 l6.326,6.325l1.547-1.547c0.845-0.845,1.311-1.968,1.311-3.163c0-1.194-0.466-2.318-1.311-3.163S25.222,3.5,24.027,3.5 s-2.318,0.465-3.163,1.31L19.316,6.358z M12.24,20.76c-0.256,0-0.512-0.098-0.707-0.293c-0.391-0.391-0.391-1.023,0-1.414 l5.134-5.134c0.391-0.391,1.023-0.391,1.414,0s0.391,1.023,0,1.414l-5.134,5.134C12.751,20.662,12.496,20.76,12.24,20.76z"})),edit:t=>{const{attributes:{prefix:i,typingTexts:o,suffix:r,typingDecoration:c,textAlign:s},setAttributes:m}=t;return[(0,e.createElement)(a.InspectorControls,{key:"setting"},(0,e.createElement)(l.PanelBody,{title:(0,n.__)("Typing Text Settings"),init:!0,ialOpen:!0},(0,e.createElement)(l.TextControl,{label:"Prefix Text",value:i,onChange:e=>m({prefix:e})}),(0,e.createElement)(l.TextareaControl,{label:"Typing Texts",help:"Separate texts with ENTER",value:Array.isArray(o)?o.join("\r\n"):o,onChange:e=>m({typingTexts:e.split("\n")})}),(0,e.createElement)(l.__experimentalToggleGroupControl,{label:"Typing Decoration",value:c,onChange:e=>m({typingDecoration:e}),isBlock:!0},(0,e.createElement)(l.__experimentalToggleGroupControlOption,{value:"",label:(0,e.createElement)("svg",{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24",width:"24",height:"24","aria-hidden":"true",focusable:"false"},(0,e.createElement)("path",{d:"M7 11.5h10V13H7z"}))}),(0,e.createElement)(l.__experimentalToggleGroupControlOption,{value:"underline",label:(0,e.createElement)("svg",{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24",width:"24",height:"24","aria-hidden":"true",focusable:"false"},(0,e.createElement)("path",{d:"M7 18v1h10v-1H7zm5-2c1.5 0 2.6-.4 3.4-1.2.8-.8 1.1-2 1.1-3.5V5H15v5.8c0 1.2-.2 2.1-.6 2.8-.4.7-1.2 1-2.4 1s-2-.3-2.4-1c-.4-.7-.6-1.6-.6-2.8V5H7.5v6.2c0 1.5.4 2.7 1.1 3.5.8.9 1.9 1.3 3.4 1.3z"}))}),(0,e.createElement)(l.__experimentalToggleGroupControlOption,{value:"line-through",label:(0,e.createElement)("svg",{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24",width:"24",height:"24","aria-hidden":"true",focusable:"false"},(0,e.createElement)("path",{d:"M9.1 9v-.5c0-.6.2-1.1.7-1.4.5-.3 1.2-.5 2-.5.7 0 1.4.1 2.1.3.7.2 1.4.5 2.1.9l.2-1.9c-.6-.3-1.2-.5-1.9-.7-.8-.1-1.6-.2-2.4-.2-1.5 0-2.7.3-3.6 1-.8.7-1.2 1.5-1.2 2.6V9h2zM20 12H4v1h8.3c.3.1.6.2.8.3.5.2.9.5 1.1.8.3.3.4.7.4 1.2 0 .7-.2 1.1-.8 1.5-.5.3-1.2.5-2.1.5-.8 0-1.6-.1-2.4-.3-.8-.2-1.5-.5-2.2-.8L7 18.1c.5.2 1.2.4 2 .6.8.2 1.6.3 2.4.3 1.7 0 3-.3 3.9-1 .9-.7 1.3-1.6 1.3-2.8 0-.9-.2-1.7-.7-2.2H20v-1z"}))})),(0,e.createElement)(l.TextControl,{label:"Suffix Text",value:r,onChange:e=>m({suffix:e})}))),(0,e.createElement)("div",(0,a.useBlockProps)({style:{textAlign:s}}),(0,e.createElement)(a.BlockControls,null,(0,e.createElement)(a.AlignmentToolbar,{value:s,onChange:e=>m({textAlign:e})})),(0,e.createElement)("div",{class:"lemmony-typing-wrapper"},(0,e.createElement)("span",{className:"lemmony-typing-prefix"},i),(0,e.createElement)("span",{className:"lemmony-typing-data hidden",style:{textDecoration:c}},o.map((t=>(0,e.createElement)("span",{className:"lemmony-typing-item"},t)))),(0,e.createElement)("span",{className:"lemmony-typing-action",style:{textDecoration:c}}),(0,e.createElement)("span",{className:"lemmony-typing-suffix"},r)))]},save:t=>{const{attributes:{prefix:n,typingTexts:l,suffix:i,typingDecoration:o,textAlign:r}}=t;return[(0,e.createElement)("div",a.useBlockProps.save({style:{textAlign:r}}),(0,e.createElement)("div",{class:"lemmony-typing-wrapper"},(0,e.createElement)("span",{className:"lemmony-typing-prefix"},n),(0,e.createElement)("span",{className:"lemmony-typing-data hidden",style:{textDecoration:o}},l.map((t=>(0,e.createElement)("span",{className:"lemmony-typing-item"},t)))),(0,e.createElement)("span",{className:"lemmony-typing-action",style:{textDecoration:o}}),(0,e.createElement)("span",{className:"lemmony-typing-suffix"},i)))]}})})();