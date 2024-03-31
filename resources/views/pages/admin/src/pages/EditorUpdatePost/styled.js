import styled from 'styled-components';
import ReactQuill from 'react-quill';

export const EditorUpdatePostContainer = styled.div``;

export const EditorUpdatePostContent = styled.div`
  position: relative;

  form {
    padding: 1rem;

    display: flex;
    flex-direction: column;
    gap: 1rem;
  }
`;

export const EditorLoading = styled.div`
  position: absolute;
  z-index: 9999;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  backdrop-filter: blur(5px);
  visibility: ${(props) =>
    props.isloading === 'no-load' ? 'visible' : 'hidden'};
  transition: visibility 1s ease-out;
`;

export const EditorUpdatePostFormGroup = styled.div`
  input {
    font-size: 0.9rem;
    height: 40px;
  }
`;

export const EditorQuill = styled(ReactQuill)`
  min-height: 600px;
  width: 100%;

  .ql-container,
  .ql-editor {
    min-height: 600px !important;
  }
`;
