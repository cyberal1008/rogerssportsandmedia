import {registerBlockType} from '@wordpress/blocks';
import {useBlockProps, RichText, URLInputButton, MediaUpload, MediaUploadCheck} from '@wordpress/block-editor';
import {Button} from '@wordpress/components';

const block_classes = {className: 'row justify-content-between flex-column-reverse flex-md-row'};
const img_col_classes = "col-8 mx-auto mb-3 col-md-6 mb-md-auto mx-md-0 col-lg-4";
const text_col_classes = "col-12 col-md-6 col-lg-6";

registerBlockType('rsm/products-block', {
    apiVersion: 2,
    title: 'Products',
    icon: 'align-pull-right',
    category:
        'design',
    attributes: {
        title: {
            type: 'string',
            source: 'text',
            selector: '.product-title'
        },
        content: {
            type: 'string',
            source: 'text',
            selector: '.product-description'
        },
        url: {
            type: 'string',
            source: 'attribute',
            selector: '.product-url-link',
            attribute: 'href',

        },
        urltext: {
            type: 'string',
            selector: '.product-url-text',
            source: 'text',
        },
        mediaid: {
            type: 'string',
            selector: '.product-image',
            source: 'attribute',
            attribute: 'data-id'
        },
        imagesrc: {
            type: 'string',
            selector: '.product-image',
            source: 'attribute',
            attribute: 'src'
        },
        imagesrcset: {
            type: 'string',
            selector: '.product-image',
            source: 'attribute',
            attribute: 'srcset'
        },
        imagesizes: {
            type: 'string',
            selector: '.product-image',
            source: 'attribute',
            attribute: 'sizes'
        },
        imagealt: {
            type: 'string',
            selector: '.product-image',
            source: 'attribute',
            attribute: 'alt'
        },
    },
    edit: (props) => {
        const {
            attributes: {title, content, url, urltext, mediaid, imagesrc, imagesrcset, imagesizes, imagealt},
            setAttributes,
        } = props;


        const blockProps = useBlockProps(block_classes);
        return (
            <div {...blockProps}>
                <div className={text_col_classes}>
                    <RichText tagName="h2"
                              placeholder='Enter Title' onChange={title => setAttributes({title})}
                              className="product-title"
                              value={title}/>
                    <RichText placeholder='Enter Description' tagName="p" onChange={content => setAttributes({content})}
                              className="product-description" value={content}/>
                    <div className="product-url">

                        <URLInputButton
                            url={url}
                            onChange={url => setAttributes({url})}
                            className="product-url-link card-button"
                        />
                        <RichText placeholder='Enter Label' tagName="span"
                                  onChange={urltext => setAttributes({urltext})}
                                  className="product-url-text" value={urltext}/>
                    </div>
                </div>
                <div className={img_col_classes}>
                    <MediaUploadCheck>
                        <MediaUpload
                            onSelect={media => {
                                setAttributes({
                                    mediaid: media.id,
                                    imagesrc: media.sizes.portrait.url,
                                    imagesrcset: media.sizes.portrait.srcset,
                                    imagesizes: media.sizes.portrait.sizes,
                                    imagealt: media.alt,
                                });
                            }}
                            value={mediaid}
                            allowedTypes={['image']}
                            render={({open}) => {
                                if (imagesrc && imagesizes && imagesrcset) {
                                    return (
                                        <img className="product-image" data-id={mediaid} src={imagesrc}
                                             srcSet={imagesrcset} sizes={imagesizes}
                                             alt={imagealt}/>
                                    );
                                } else {
                                    return (
                                        <Button onClick={open}>Select a portrait image</Button>
                                    );
                                }
                            }}
                        />
                    </MediaUploadCheck>
                    {mediaid &&
                    <MediaUploadCheck>
                        <Button onClick={() => {
                            setAttributes({
                                mediaid: '',
                                imagesrc: '',
                                imagesrcset: '',
                                imagesizes: '',
                                imagealt: '',
                            });
                        }} isLink isDestructive>Remove image</Button>
                    </MediaUploadCheck>
                    }
                </div>
            </div>
        );
    },
    save: ({attributes}) => {
        // console.log(props.attributes);
        const blockProps = useBlockProps.save(block_classes);
        return (
            <div {...blockProps}>
                <div className={text_col_classes}>
                    <RichText.Content tagName="h2" className="product-title"
                                      value={attributes.title}/>
                    <RichText.Content tagName="p" className="product-description"
                                      value={attributes.content}/>
                    <div className="product-url">
                        <a href={attributes.url} className="product-url-link card-button">
                            <RichText.Content tagName="span" className="product-url-text" value={attributes.urltext}/>
                        </a>
                    </div>
                </div>
                <div className={img_col_classes}>
                    <img className="product-image" data-id={attributes.mediaid} src={attributes.imagesrc}
                         srcSet={attributes.imagesrcset}
                         sizes={attributes.imagesizes}
                         alt={attributes.imagealt}/>
                </div>
            </div>
        );
    }
});